@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<h3 class="mb-3">Pinjam Buku</h3>

<div class="card">
    <div class="card-body">
        <form action="{{ route('borrowings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Anggota</label>
                <select name="member_id" class="form-select @error('member_id') is-invalid @enderror">
                    <option value="">-- Pilih anggota --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                            {{ $member->member_code }} - {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('member_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="text" class="form-control" value="{{ $borrowDate->format('d/m/Y') }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jatuh Tempo (otomatis +7 hari)</label>
                    <input type="text" class="form-control" value="{{ $dueDate->format('d/m/Y') }}" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Buku yang dipinjam</label>
                @error('book_ids') <div class="text-danger small mb-1">{{ $message }}</div> @enderror
                @forelse ($books as $book)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="book_ids[]"
                               value="{{ $book->id }}" id="book{{ $book->id }}"
                               @checked(in_array($book->id, old('book_ids', [])))>
                        <label class="form-check-label" for="book{{ $book->id }}">
                            {{ $book->title }} <span class="text-muted">({{ $book->author }}, stok: {{ $book->stock }})</span>
                        </label>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada buku dengan stok tersedia.</p>
                @endforelse
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection