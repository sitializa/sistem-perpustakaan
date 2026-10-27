@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Peminjaman</h3>
    <a href="#" class="btn btn-primary disabled">Pinjam Buku</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Petugas</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowings->firstItem() + $loop->index }}</td>
                        <td>{{ $borrowing->member->name }}</td>
                        <td>{{ $borrowing->petugas->name }}</td>
                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $borrowing->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ $borrowing->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada transaksi peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $borrowings->links('pagination::bootstrap-5') }}
</div>
@endsection