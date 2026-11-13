<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    public function store(MemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

        /**
         * Display the specified resource.
         */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        if ($member->borrowings()->exists()) {
            return redirect()->route('members.index')
                ->with('error', 'Anggota tidak bisa dihapus karena sudah punya riwayat peminjaman.');
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
