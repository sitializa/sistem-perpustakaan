@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<h3 class="mb-3">Detail Anggota</h3>

<div class="card">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Kode Anggota</dt>
            <dd class="col-sm-9">{{ $member->member_code }}</dd>

            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ $member->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $member->email ?? '-' }}</dd>

            <dt class="col-sm-3">Telepon</dt>
            <dd class="col-sm-9">{{ $member->phone ?? '-' }}</dd>

            <dt class="col-sm-3">Alamat</dt>
            <dd class="col-sm-9">{{ $member->address ?? '-' }}</dd>
        </dl>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection