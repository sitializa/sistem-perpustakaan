@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Judul Buku</div>
                    <div class="display-6">{{ $stats['total_titles'] }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Stok Buku</div>
                    <div class="display-6">{{ $stats['total_stock'] }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Anggota</div>
                    <div class="display-6">{{ $stats['total_members'] }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Sedang Dipinjam</div>
                    <div class="display-6">{{ $stats['active_borrowings'] }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection