@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h1 class="h3 mb-3">Edit Buku</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}">
                </div>

                <div class="mb-3">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="year" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $book->year) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" value="{{ old('stock', $book->stock) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection