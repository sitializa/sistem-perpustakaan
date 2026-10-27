@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Detail Buku</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th style="width: 200px">Judul</th>
                    <td>{{ $book->title }}</td>
                </tr>
                <tr>
                    <th>Penulis</th>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $book->category->name }}</td>
                </tr>
                <tr>
                    <th>Penerbit</th>
                    <td>{{ $book->publisher ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tahun Terbit</th>
                    <td>{{ $book->year ?? '-' }}</td>
                </tr>
                <tr>
                    <th>ISBN</th>
                    <td>{{ $book->isbn ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>{{ $book->stock }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
    </div>
@endsection