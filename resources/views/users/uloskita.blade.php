@extends('layouts.User')

@section('content')

<div class="hero-header">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
        <p>Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditenun dengan keahlian dan tradisi turun-temurun.</p>
        <div class="hero-buttons">
            <a href="#tentang" class="btn btn-secondary">Tentang Ulos</a>
        </div>
    </div>
</div>










<div class="traditional-pattern-divider"></div>


<div class="section-title-container" id="tentang">
    <div class="section-decoration left"></div>
    <h2 class="section-title">Jenis Jenis Ulos Dan Kegunaannya</h2>
    <div class="section-decoration right"></div>
</div>

<!-- Improved Cards Layout -->
<div class="ulos-showcase">
    <div class="container">
        <div class="row ulos-grid">
            @foreach($ulosData as $index => $ulos)
            <div class="col-lg-6 col-md-12 mb-4 ulos-item">
                <div class="ulos-card">
                    <div class="ulos-card-media">
                        <img src="{{ asset('img/ulos/' . $ulos['image']) }}" alt="{{ $ulos['name'] }}" class="ulos-img">
                       
                    </div>
                    <div class="ulos-card-body">
                        <h3 class="ulos-card-title">{{ $ulos['name'] }}</h3>
                        <div class="ulos-card-divider"></div>
                        <p class="ulos-card-description">{{ Str::limit($ulos['short_description'], 120) }}</p>
                        <a href="{{ route('uloskita.detail', ['jenis' => $ulos['slug']]) }}" class="ulos-card-btn">
                            Lihat Detail
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>




<style>
:root {
    --primary-color: #7B2CBF;
    --primary-light: #9D4EDD;
    --primary-dark: #5A189A;
    --secondary-color: #FF9E00;
    --secondary-light: #FFB700;
    --secondary-dark: #DB8400;
    --text-color:#333333;
    --text-light: #666666;
    --background-light: #F9F7FE;
    --white: #FFFFFF;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
    --gradient-overlay: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));
}


.hero-header {
    position: relative;
    height: 500px;
    background-image: url('{{ asset("img/ulos/backgroundhome.png") }}');
    background-size: cover;
    background-position: center;
    margin-bottom: 60px;
    display: flex;
    align-items: center;
}

.hero-overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.05);
    
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
    text-align: center;
}

.hero-content h1 {
    color: black;
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
 
}

.hero-content p {
    color: black;
    font-size: 1.2rem;
    margin-bottom: 30px;
    font-weight: 300;
   
    
}

.hero-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.btn {
    display: inline-block;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: var(--transition);
}

.btn-primary {
    background-color: #FF9E00;;
    color: var(--white);
    border: none;
    box-shadow: 0 4px 15px #FF9E00;(255, 158, 0, 0.3);
}

.btn-primary:hover {
    background-color: var(--secondary-dark);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px #FF9E00(255, 158, 0, 0.4);
}

.btn-secondary {
    background-color: black;
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
}

.btn-secondary:hover {
    background-color: rgba(228, 228, 18, 0.3);
    border-color: var(--white);
    transform: translateY(-3px);
}

.traditional-pattern-divider {
    height: 30px;
    background-image: url('{{ asset("img/ulos/ulos_atakanta.jpg") }}');
    background-repeat: repeat-x;
    background-size: auto 100%;
    margin-bottom: 40px;
}


.section-title-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 50px;
    padding: 0 20px;
}

.section-decoration {
    height: 2px;
    flex: 1;
    max-width: 100px;
    background: linear-gradient(to right, transparent, var(--primary-color));
}

.section-decoration.right {
    background: linear-gradient(to left, transparent, var(--primary-color));
}

.section-title {
    color: var(--primary-dark);
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 20px;
    text-align: center;
    position: relative;
}

/* Improved Ulos Cards Styles */
.ulos-showcase {
    padding: 0 0 80px;
    background-color: var(--background-light);
}

.ulos-grid {
    position: relative;
}

.ulos-card {
    position: relative;
    height: 100%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    background-color: var(--white);
    display: flex;
    flex-direction: row;
}

.ulos-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(27, 25, 181, 0.15);
}

.ulos-card-media {
    position: relative;
    width: 40%;
    overflow: hidden;
}

.ulos-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.ulos-card:hover .ulos-img {
    transform: scale(1.05);
}

.ulos-card-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: var(--secondary-color);
    color: var(--white);
    padding: 5px 15px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 2;
}

.ulos-card-body {
    width: 60%;
    padding: 25px;
    display: flex;
    flex-direction: column;
}

.ulos-card-title {
    color: black;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    transition: var(--transition);
}

.ulos-card-divider {
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    margin-bottom: 15px;
}

.ulos-card-description {
    color: var(--text-light);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

.ulos-card-btn {
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    padding: 8px 0;
    position: relative;
    transition: var(--transition);
}

.ulos-card-btn::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary-color);
    transition: var(--transition);
}

.ulos-card-btn i {
    margin-left: 8px;
    transition: var(--transition);
}

.ulos-card-btn:hover {
    color: var(--secondary-color);
}

.ulos-card-btn:hover::after {
    width: 100%;
    background-color: var(--secondary-color);
}

.ulos-card-btn:hover i {
    transform: translateX(5px);
    color: var(--secondary-color);
}

/* Info Section Styles */
.info-section {
    padding: 80px 0;
    background-color: var(--white);
}

.info-content {
    padding: 30px 0;
}

.info-content h2 {
    color: var(--primary-dark);
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.info-content p {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 25px;
}

.info-list {
    list-style: none;
    padding: 0;
}

.info-list li {
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    color: var(--text-color);
}

.info-list li i {
    color: var(--secondary-color);
    margin-right: 10px;
    font-size: 1.1rem;
}

.info-image {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.info-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.info-image-decoration {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    background-color: var(--primary-light);
    opacity: 0.2;
    border-radius: 50%;
    z-index: -1;
}


.traditional-pattern-footer {
    height: 30px;
    background-image: url('{{ asset("img/ulos/pattern.png") }}');
    background-repeat: repeat-x;
    background-size: auto 100%;
    margin-top: 30px;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .hero-header {
        height: 400px;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .hero-content p {
        font-size: 1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        gap: 15px;
        
    }
    
    .btn {
        width: 100%;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .ulos-card {
        flex-direction: column;
    }
    
    .ulos-card-media {
        width: 100%;
        height: 200px;
    }
    
    .ulos-card-body {
        width: 100%;
    }
    
    .info-image {
        margin-top: 30px;
    }
}

@media (max-width: 576px) {
    .hero-header {
        height: 350px;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
        color: black;
    }
    
    .section-title {
        font-size: 1.5rem;
        color: black;
    }
    
    .section-decoration {
        max-width: 60px;
    }
}

.section-title{
    color: black;


}

.ulos-card-body {
    color: black
}
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
       
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection