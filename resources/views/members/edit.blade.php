@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<h3 class="mb-3">Edit Anggota</h3>

<div class="card">
    <div class="card-body">
        <form action="{{ route('members.update', $member) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Anggota</label>
                <input type="text" name="member_code" value="{{ old('member_code', $member->member_code) }}"
                       class="form-control @error('member_code') is-invalid @enderror">
                @error('member_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                       class="form-control @error('phone') is-invalid @enderror">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" rows="3"
                          class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address) }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection