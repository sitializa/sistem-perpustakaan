@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<h3 class="mb-3">Detail Peminjaman #{{ $borrowing->id }}</h3>

<div class="card mb-3">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Anggota</dt>
            <dd class="col-sm-9">{{ $borrowing->member->member_code }} - {{ $borrowing->member->name }}</dd>

            <dt class="col-sm-3">Petugas</dt>
            <dd class="col-sm-9">{{ $borrowing->petugas->name }}</dd>

            <dt class="col-sm-3">Tanggal Pinjam</dt>
            <dd class="col-sm-9">{{ $borrowing->borrow_date->format('d/m/Y') }}</dd>

            <dt class="col-sm-3">Jatuh Tempo</dt>
            <dd class="col-sm-9">{{ $borrowing->due_date->format('d/m/Y') }}</dd>

            <dt class="col-sm-3">Tanggal Kembali</dt>
            <dd class="col-sm-9">{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</dd>

            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
                <span class="badge {{ $borrowing->status === 'borrowed' ? 'bg-warning text-dark' : 'bg-success' }}">
                    {{ $borrowing->status }}
                </span>
            </dd>
        </dl>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">Buku yang dipinjam</div>
    <ul class="list-group list-group-flush">
        @foreach ($borrowing->items as $item)
            <li class="list-group-item">
                {{ $item->book->title }}
                <span class="text-muted">({{ $item->book->author }}) x{{ $item->quantity }}</span>
            </li>
        @endforeach
    </ul>
</div>

@if ($borrowing->status === 'borrowed')
    <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Kembalikan semua buku pada transaksi ini?')">
        @csrf
        <button type="submit" class="btn btn-success">Kembalikan Buku</button>
    </form>
@endif
<a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
@endsection