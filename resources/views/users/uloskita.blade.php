@extends('layouts.User')

@section('content')
<div class="container-fluid p-0">

    <div class="text-center hero-section">
        <div class="hero-overlay">
            <h1 class="display-4 mb-4">Menghidupkan Kembali Pesona Ulos Batak dengan Sentuhan Keahlian Turun-temurun</h1>
        </div>
    </div>
    

    <div class="container-fluid text-center subtitle-section">
        <h2 class="mb-0">Jenis Jenis Ulos Dan Kegunaannya</h2>
    </div>
    
    <!-- Cards Section -->
    <div class="container">
        <div class="row">
            @foreach($ulosData as $ulos)
            <div class="col-md-6 mb-4">
                <div class="card ulos-card">
                    <div class="row no-gutters">
                        <div class="col-md-5 ulos-image-container">
                            <img src="{{ asset('img/ulos/' . $ulos['image']) }}" alt="{{ $ulos['name'] }}" class="img-fluid ulos-image">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body ulos-content">
                                <div class="ulos-title-container">
                                    <h4 class="ulos-title">
                                        <span class="ulos-title-text">{{ $ulos['name'] }}</span>
                                    </h4>
                                    
                                </div>
                                <p class="ulos-description">{{ Str::limit($ulos['short_description'], 100) }}</p>
                                <a href="{{ route('uloskita.detail', ['jenis' => $ulos['slug']]) }}" class="ulos-explore-btn">
                                    Lihat Detail Ulos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection