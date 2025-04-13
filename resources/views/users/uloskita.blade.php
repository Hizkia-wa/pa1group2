@extends('layouts.User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Jenis-jenis Ulos Kita</h2>
    
    <div class="row">
        <!-- Looping through each type of ulos -->
        @foreach($ulosData as $ulos)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('img/ulos/' . $ulos['image']) }}" alt="{{ $ulos['name'] }}" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <!-- Make the ulos name clickable -->
                            <h4>
                                <a href="{{ route('uloskita.detail', ['jenis' => $ulos['slug']]) }}" class="text-primary text-decoration-none">
                                    {{ $ulos['name'] }}
                                </a>
                            </h4>
                            <!-- Short description preview -->
                            <p class="text-muted small">{{ Str::limit($ulos['short_description'], 100) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection