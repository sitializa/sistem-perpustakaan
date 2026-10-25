@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px">No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Buku</th>
                        <th style="width: 160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td class="text-center">{{ $category->books_count }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection