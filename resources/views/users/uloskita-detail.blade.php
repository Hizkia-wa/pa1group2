@extends('layouts.User')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('img/ulos/' . $ulosDetail['image']) }}" alt="{{ $ulosDetail['name'] }}" class="img-fluid mb-3">
            
        </div>
        <div class="col-md-8">
            <h2>{{ $ulosDetail['name'] }}</h2>
            
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Deskripsi</h5>
                </div>
                <div class="card-body">
                    {!! $ulosDetail['description'] !!}
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kegunaan</h5>
                </div>
                <div class="card-body">
                    {!! $ulosDetail['kegunaan'] !!}
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-purple text-white" style="background-color: #9b59b6;">
                    <h5 class="mb-0">Proses Pembuatan</h5>
                </div>
                <div class="card-body">
                    {!! $ulosDetail['pembuatan'] !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection