@extends('layouts.admin')

@section('title', 'Manajemen Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Admin</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Tambah Admin</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->AdminName }}</td>
                        <td>{{ $admin->Email }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada admin terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
