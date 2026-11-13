<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'petugas'])
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

        public function create()
    {
        $members = Member::orderBy('name')->get();
        $books = Book::where('stock', '>', 0)->orderBy('title')->get();
        $borrowDate = now();
        $dueDate = now()->addDays(7);

        return view('borrowings.create', compact('members', 'books', 'borrowDate', 'dueDate'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id'  => 'required|exists:members,id',
            'book_ids'   => 'required|array|min:1',
            'book_ids.*' => 'exists:books,id|distinct',
        ], [
            'member_id.required' => 'Anggota wajib dipilih.',
            'member_id.exists'   => 'Anggota tidak ditemukan.',
            'book_ids.required'  => 'Pilih minimal satu buku.',
            'book_ids.min'       => 'Pilih minimal satu buku.',
        ]);

        // Sementara pakai user pertama; diganti Auth::id() setelah login jadi (P14)
        $petugasId = User::orderBy('id')->value('id');

        DB::transaction(function () use ($validated, $petugasId) {
            $borrowDate = now()->toDateString();

            $borrowing = Borrowing::create([
                'petugas_id'  => $petugasId,
                'member_id'   => $validated['member_id'],
                'borrow_date' => $borrowDate,
                'due_date'    => now()->addDays(7)->toDateString(),
                'status'      => 'borrowed',
            ]);

            foreach ($validated['book_ids'] as $bookId) {
                $book = Book::lockForUpdate()->findOrFail($bookId);

                if ($book->stock < 1) {
                    throw ValidationException::withMessages([
                        'book_ids' => "Stok buku \"{$book->title}\" habis.",
                    ]);
                }

                $borrowing->items()->create([
                    'book_id'  => $book->id,
                    'quantity' => 1,
                ]);

                $book->decrement('stock');
            }
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'petugas', 'items.book']);

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return redirect()->route('borrowings.show', $borrowing)
                ->with('error', 'Transaksi ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($borrowing) {
            foreach ($borrowing->items as $item) {
                Book::where('id', $item->book_id)->increment('stock', $item->quantity);
            }

            $borrowing->update([
                'return_date' => now()->toDateString(),
                'status'      => 'returned',
            ]);
        });

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
    }

}