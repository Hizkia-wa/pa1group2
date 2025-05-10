@extends('Layouts.User')

@section('content')
<div class="container py-4">
    <!-- Header Section - Lebih compact dan rapi -->
    <div class="hero-section" data-aos="fade-zoom-in" data-aos-delay="200">
        <div class="hero-content">
            <h1 class="main-title">Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
            <p class="subtitle">
                Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditenun dengan keahlian dan tradisi turun-temurun.
            </p>
            <div class="hero-buttons">
                <a href="#sejarahumkm" class="btn-primary">Sejarah <span class="arrow">→</span></a>
                <a href="#UMKMnya" class="btn-secondary">Pemilik <span class="arrow">→</span></a>
            </div>
        </div>
    </div>

    <!-- Sejarah Section - Layout lebih bersih -->
    <div class="section-container" id="sejarahumkm" data-aos="fade-right">
        <h2 class="section-title">Sejarah Berdirinya Toko Gita Ulos</h2>
        <div class="content-wrapper">
            <div class="text-content">
                <p>
                    Gita Ulos bermula dari perjalanan cinta terhadap warisan budaya Batak yang dirintis oleh keluarga Simanjuntak pada tahun 2015. Berawal dari keprihatinan melihat semakin sedikitnya penenun tradisional Ulos yang mampu bertahan di era modern, Ibu Tiurma Simanjuntak yang merupakan putri asli Toba, memutuskan untuk membuka usaha kecil di rumahnya di Balige.
                </p>
                <p>
                    Dengan modal awal berupa 5 lembar Ulos warisan keluarga dan keterampilan menenun yang dipelajari dari neneknya, Ibu Tiurma mulai memproduksi Ulos dengan mempertahankan teknik tradisional namun dengan sentuhan desain yang lebih kontemporer. Keunikan ini menarik perhatian wisatawan yang berkunjung ke Danau Toba.
                </p>
                <p>
                    Pada tahun 2018, putra Ibu Tiurma, Mangasi Simanjuntak, yang baru menyelesaikan pendidikan di bidang bisnis, bergabung dan membawa inovasi baru dengan membuka platform online untuk menjangkau pasar yang lebih luas. Nama "Gita" dipilih sebagai penghormatan kepada nenek mereka yang merupakan penenun Ulos terkenal di kampungnya.
                </p>
            </div>
            <div class="image-container" data-aos="zoom-in-up" data-aos-delay="300">
                <img src="img/ulos/partonun.jpeg" alt="Keluarga Gita Ulos" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Pemilik Section - Lebih seimbang -->
    <div class="section-container bg-light" id="UMKMnya" data-aos="fade-left">
        <h2 class="section-title">Pemilik Gita Ulos</h2>
        <div class="content-wrapper reverse">
            <div class="text-content">
                <p>
                    Gita Ulos dengan bangga menjalin kemitraan dengan para penenun (partonun) terbaik yang membawa keahlian dan warisan budaya dalam setiap helai tenunan:
                </p>
                <div class="owner-card">
                    <h3 class="owner-name">Nai Tiurma Situmorang (65 tahun)</h3>
                    <p>
                        Berasal dari Desa Lumban Suhi-suhi, Samosir, Nai Tiurma telah menenun selama lebih dari 45 tahun. Keahliannya dalam menciptakan motif Ragidup dengan teknik songket tradisional menjadikan karyanya sangat dicari. Proses menenunnya masih menggunakan alat tenun gedogan warisan dari ibunya, dengan pewarna alami dari tumbuhan lokal seperti kulit manggis dan daun sirih. Setiap lembar Ulos buatannya memerlukan waktu pengerjaan hingga dua bulan.
                    </p>
                </div>
            </div>
            <div class="image-container" data-aos="flip-left" data-aos-delay="200">
                <img src="img/background.png" alt="Pemilik Gita Ulos" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Visi & Misi Section - Layout standar dengan tampilan card -->
    <div class="section-container">
        <h2 class="section-title">Visi & Misi Gita Ulos</h2>
        <div class="row">
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="vision-mission-card">
                    <h3>Visi</h3>
                    <p>Menjadi pusat pelestarian dan pengembangan Ulos Batak yang diakui secara nasional dan internasional, serta menjadi jembatan penghubung antara warisan budaya tradisional dengan generasi modern.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="vision-mission-card">
                    <h3>Misi</h3>
                    <ul>
                        <li>Melestarikan teknik tradisional pembuatan Ulos melalui pelatihan dan dokumentasi.</li>
                        <li>Memberdayakan para penenun lokal, khususnya perempuan di daerah Danau Toba.</li>
                        <li>Mengembangkan desain Ulos yang kontemporer tanpa menghilangkan nilai filosofis dan kultural.</li>
                        <li>Mengedukasi masyarakat luas tentang makna dan nilai sejarah di balik setiap motif Ulos.</li>
                        <li>Memperluas pasar Ulos ke tingkat nasional dan internasional melalui platform digital.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- Location & Contact -->
<div class="container my-5" data-aos="fade-up" data-aos-duration="800">
  <h3 class="text-center mb-5 fw-bold text-primary" data-aos="zoom-in" data-aos-delay="100">📍 Lokasi & Kontak Kami</h3>
  
  <div class="row g-4 align-items-stretch">
    
    <!-- Map -->
    <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
      <div class="shadow rounded-4 overflow-hidden">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.201663504994!2d99.15515687592641!3d2.4397623975392104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ffc56771a24b%3A0x52c629ec1d6260d1!2sGITA%20ULOS!5e0!3m2!1sid!2sid!4v1746016363635!5m2!1sid!2sid" 
          width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
          class="rounded-4 w-100">
        </iframe>
      </div>
    </div>

    <!-- Contact Info -->
    <div class="col-md-6" data-aos="fade-left" data-aos-delay="400">
      <div class="card shadow rounded-4 h-100">
        <div class="card-body p-4">
          <h5 class="mb-3 text-dark fw-semibold">
            <i class="bi bi-telephone-fill me-2 text-success"></i>Telepon & WhatsApp
          </h5>
          <p class="ms-4">+62 812 3456 7890</p>

          <h5 class="mb-3 mt-4 text-dark fw-semibold">
            <i class="bi bi-envelope-fill me-2 text-danger"></i>Email
          </h5>
          <p class="ms-4">info@gitaulos.com</p>

          <h5 class="mb-3 mt-4 text-dark fw-semibold">
            <i class="bi bi-clock-fill me-2 text-warning"></i>Jam Buka
          </h5>
          <ul class="ms-4 mb-0 list-unstyled">
            <li>Senin - Jumat: 08:00 - 17:00</li>
            <li>Sabtu: 09:00 - 15:00</li>
            <li>Minggu: <span class="text-muted">Tutup</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<style>
:root {
    --primary-color: #7B2CBF;
    --secondary-color: #FF9E00;
    --text-color: #333333;
    --text-light: #666666;
    --background-light: #F9F7FE;
    --white: #FFFFFF;
    --shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Poppins', sans-serif;
    color: var(--text-color);
    line-height: 1.6;
}

.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
    color: #333333;
    font-weight: 600;
    margin-bottom: 15px;
}

.section-title {
    color: #333333;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
    position: relative;
    padding-bottom: 12px;
}

.section-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background-color: var(--secondary-color);
}

p {
    color: #333333;
    margin-bottom: 15px;
    line-height: 1.7;
}

/* Header / Hero Section */
.hero-section {
    background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url("{{ asset('img/ulos/backgroundhome.png') }}");
    background-size: cover;
    background-position: center;
    padding: 60px 0;
    border-radius: 8px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.hero-content {
    text-align: center;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.85);
    border-radius: 8px;
    max-width: 800px;
    margin: 0 auto;
}

.main-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333333;
}

.subtitle {
    font-size: 1rem;
    max-width: 600px;
    margin: 0 auto 25px;
    line-height: 1.6;
    color: #333333;
}

.hero-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-primary {
    background-color: var(--secondary-color);
    color: white;
}

.btn-secondary {
    background-color: #333333;
    color: white;
    border: 1px solid white;
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.arrow {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.btn-primary:hover .arrow, .btn-secondary:hover .arrow {
    transform: translateX(3px);
}

/* Sections Layout */
.section-container {
    padding: 40px 0;
    margin-bottom: 20px;
}

.bg-light {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 30px 20px;
}

.content-wrapper {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 30px;
    margin-bottom: 20px;
}

.content-wrapper.reverse {
    flex-direction: row-reverse;
}

.text-content {
    flex: 3;
    min-width: 300px;
}

.image-container {
    flex: 2;
    min-width: 250px;
}

.image-container img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.image-container img:hover {
    transform: scale(1.02);
}

/* Owner Card */
.owner-card {
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    margin-top: 15px;
}

.owner-name {
    color: #333333;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

/* Vision & Mission */
.vision-mission-card {
    height: 100%;
    padding: 25px;
    border-radius: 8px;
    box-shadow: var(--shadow);
    background-color: white;
    transition: var(--transition);
}

.vision-mission-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.vision-mission-card h3 {
    color: #333333;
    font-size: 1.4rem;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--secondary-color);
    display: inline-block;
}

.vision-mission-card ul {
    padding-left: 18px;
    margin-bottom: 0;
}

.vision-mission-card li {
    margin-bottom: 8px;
    position: relative;
    color: #333333;
}

.vision-mission-card li::marker {
    color: var(--secondary-color);
}

/* Contact Section */
.map-container {
    height: 100%;
    min-height: 300px;
}

.map-container iframe {
    border: none;
    width: 100%;
    height: 100%;
    min-height: 300px;
    border-radius: 8px;
    box-shadow: var(--shadow);
}

.contact-card {
    height: 100%;
    background-color: white;
    border-radius: 8px;
    box-shadow: var(--shadow);
    padding: 25px;
    transition: var(--transition);
}

.contact-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.contact-info {
    margin-bottom: 20px;
}

.contact-info:last-child {
    margin-bottom: 0;
}

.contact-info h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #333333;
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}

.contact-info p {
    font-size: 0.95rem;
    color: #333333;
    margin-bottom: 0;
    padding-left: 25px;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .content-wrapper, .content-wrapper.reverse {
        flex-direction: column;
    }
    
    .image-container {
        order: 1;
        margin-bottom: 20px;
    }
    
    .text-content {
        order: 2;
    }
    
    .hero-content {
        padding: 25px 15px;
    }
    
    .main-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 1.6rem;
    }
    
    .vision-mission-card, .owner-card, .contact-card {
        padding: 20px 15px;
    }
    
    .hero-section {
        padding: 40px 0;
    }
    
    .contact-info h5 {
        font-size: 0.95rem;
    }
    
    .contact-info p {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .main-title {
        font-size: 1.5rem;
    }
    
    .subtitle {
        font-size: 0.9rem;
    }
    
    .btn-primary, .btn-secondary {
        padding: 8px 16px;
        font-size: 0.85rem;
    }
    
    .section-container {
        padding: 30px 0;
    }
}
</style>
@endsection