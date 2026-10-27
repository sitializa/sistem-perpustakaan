<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'petugas'])
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }
}