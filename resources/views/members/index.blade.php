@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Daftar Anggota</h3>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Anggota</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                    <tr>
                        <td>{{ $members->firstItem() + $loop->index }}</td>
                        <td>{{ $member->member_code }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email ?? '-' }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus anggota ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $members->links('pagination::bootstrap-5') }}
</div>
@endsection