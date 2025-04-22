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

<style>



    /* Ulos Batak Page Styling - Based on uploaded design system */

/* Hero Section Styling */
.hero-section {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 400px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-light);
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(106, 27, 154, 0.7);  /* Primary color with opacity */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 20px;
}

.hero-section h1 {
    font-weight: 700;
    max-width: 900px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    z-index: 2;
}

/* Subtitle Section */
.subtitle-section {
    background-color: var(--lighter-gray);
    padding: 30px 0;
    border-bottom: 1px solid var(--border-color);
}

.subtitle-section h2 {
    color: var(--primary-color);
    font-weight: 600;
    position: relative;
    display: inline-block;
    padding-bottom: 10px;
}

.subtitle-section h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color: var(--accent-color);
}

/* Ulos Cards */
.ulos-card {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 12px var(--shadow-light);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top: 30px;
    height: 100%;
}

.ulos-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px var(--shadow-medium);
}

.ulos-image-container {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    height: 100%;
    background-color: var(--light-gray);
}

.ulos-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.ulos-card:hover .ulos-image {
    transform: scale(1.05);
}

.ulos-content {
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.ulos-title-container {
    margin-bottom: 15px;
    position: relative;
}

.ulos-title {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 0;
    position: relative;
    display: inline-block;
}

.ulos-title-text {
    position: relative;
    z-index: 1;
}

.ulos-title:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: var(--accent-color);
    opacity: 0.4;
    z-index: 0;
}

.ulos-description {
    color: var(--text-secondary);
    margin-bottom: 20px;
    flex-grow: 1;
    line-height: 1.6;
}

.ulos-explore-btn {
    display: inline-block;
    background-color: var(--primary-color);
    color: var(--text-light);
    padding: 10px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    align-self: flex-start;
    box-shadow: 0 2px 10px rgba(106, 27, 154, 0.2);
}

.ulos-explore-btn:hover {
    background-color: var(--secondary-color);
    box-shadow: 0 4px 15px rgba(106, 27, 154, 0.3);
    transform: translateY(-2px);
    color: var(--text-light);
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .ulos-card .row {
        flex-direction: column;
    }
    
    .ulos-image-container {
        height: 200px;
    }
    
    .hero-section h1 {
        font-size: 1.8rem;
    }
}
</style>















@endsection



