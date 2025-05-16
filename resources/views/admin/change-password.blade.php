@extends('layouts.Admin') {{-- Ganti dengan layout admin kamu --}}

@section('content')
<div class="container mt-5">
    <h2>Ubah Password Admin</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.changePassword') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Password Lama</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label>Password Baru</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah</button>
    </form>
</div>
@endsection
