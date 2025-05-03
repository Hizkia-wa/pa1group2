@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="hero-section">
        <h1 class="main-title">Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
        <p class="subtitle">
            Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditenun dengan keahlian dan tradisi turun-temurun.
        </p>
        <div class="hero-buttons">
            <a href="#sejarahumkm" class="btn-primary">Sejarah <span class="arrow">→</span></a>
            <a href="#UMKMnya" class="btn-secondary">Pemilik</a>
        </div>
    </div>

    <div class="history-section" id="sejarahumkm">
        <h2 class="section-title">Sejarah Berdirinya Toko Gita Ulos</h2>
        <div class="history-content">
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
        <div class="family-image">
            <img src="img/ulos/partonun.jpeg" alt="Keluarga Gita Ulos">
        </div>
    </div>

    <div class="owners-section" id="UMKMnya">
        <h2 class="section-title">Pemilik Gita Ulos</h2>
        <div class="owner-content">
            <div class="owner-text">
                <p>
                    Gita Ulos dengan bangga menjalin kemitraan dengan para penenun (penenun) terbaik yang membawa keahlian dan warisan budaya dalam setiap helai tenunan:
                </p>
                <div class="owner-details">
                    <h3 class="owner-name">Nai Tiurma Situmorang (65 tahun)</h3>
                    <p>
                        Berasal dari Desa Lumban Suhi-suhi, Samosir, Nai Tiurma telah menenun selama lebih dari 45 tahun. Keahliannya dalam menciptakan motif Ragidup dengan teknik songket tradisional menjadikan karyanya sangat dicari. Proses menenunnya masih menggunakan alat tenun gedogan warisan dari ibunya, dengan pewarna alami dari tumbuhan lokal seperti kulit manggis dan daun sirih. Setiap lembar Ulos buatannya memerlukan waktu pengerjaan hingga dua bulan.
                    </p>
                </div>
            </div>
            <div class="owner-image">
                <img src="img/background.png" alt="Pemilik Gita Ulos">
            </div>
        </div>
    </div>



    <div class="vision-mission-section">
        <h2 class="section-title">Visi & Misi Gita Ulos</h2>
        <div class="vision-mission-content">
            <div class="vision-box">
                <h3>Visi</h3>
                <p>Menjadi pusat pelestarian dan pengembangan Ulos Batak yang diakui secara nasional dan internasional, serta menjadi jembatan penghubung antara warisan budaya tradisional dengan generasi modern.</p>
            </div>
            <div class="mission-box">
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


    <div class="container my-5">
      <div class="row">
          <div class="col-md-6">
              <h3>Lokasi & Kontak Kami</h3>
              <div class="map-container">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.1268481704317!2d98.6734735!3d3.5889271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312f94c65f63dd%3A0xf9a21acec1195170!2sMedan%2C%20Kota%20Medan%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1650123456789!5m2!1sid!2sid" 
                      width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          </div>
          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title mb-4">Telepon & WhatsApp</h5>
                      <p><i class="bi bi-telephone me-2"></i> +62 812 3456 7890</p>
                      
                      <h5 class="card-title mb-4 mt-4">Email</h5>
                      <p><i class="bi bi-envelope me-2"></i> info@gitaulos.com</p>
                      
                      <h5 class="card-title mb-4 mt-4">Jam Buka</h5>
                      <p>
                          Senin - Jumat: 08:00 - 17:00<br>
                          Sabtu: 09:00 - 15:00<br>
                          Minggu: Tutup
                      </p>
                  </div>
              </div>
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

body {
  font-family: 'Poppins', sans-serif;
  color: var(--text-color);
  line-height: 1.6;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}


h1, h2, h3, h4, h5, h6, .section-title, .main-title, .owner-name {
  color: var(--text-color);
  font-weight: 700;
  color: black;
    font-size: 3rem;
    margin-bottom: 20px
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
/* Hero Section */
.hero-section {
  background: url("{{ asset('img/ulos/backgroundhome.png') }}");
  background-size: cover;
  background-position: center;
  color: var(--text-light);
  padding: 120px 20px;
  text-align: center;
  border-radius: 8px;
  margin-bottom: 60px;
}

.main-title {
  font-size: 2.8rem;
  font-weight: 700;
  margin-bottom: 20px;
  text-shadow: 0 2px 4px black(0, 0, 0, 0.2);
}

.subtitle {
  font-size: 1.2rem;
  max-width: 680px;
  margin: 0 auto 40px;
  line-height: 1.8;
}

.hero-buttons {
  display: flex;
  justify-content: center;
  gap: 16px;
  flex-wrap: wrap;
  
}

.btn-primary {
  background-color: #FF9E00;
  color: white;
  padding: 12px 24px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
}

.btn-primary:hover {
  background-color: var(--secondary-color);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(106, 27, 154, 0.3);
}

.btn-secondary {
  background-color: black;
  color: white;
  padding: 12px 24px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  border: 2px solid white;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background-color: rgba(195, 64, 17, 0.2);
  transform: translateY(-2px);
}

.arrow {
  margin-left: 8px;
  transition: transform 0.3s ease;
}

.btn-primary:hover .arrow {
  transform: translateX(4px);
}

/* Section Styles */
.section-title {
  color: var(--text-color);
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 30px;
  text-align: center;
  position: relative;
  padding-bottom: 15px;
}

.section-title::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background-color: var(--primary-color);
}

/* History Section */
.history-section {
  padding: 60px 0;
}

.history-content {
  margin-bottom: 30px;
}

.history-content p {
  margin-bottom: 20px;
  text-align: justify;
}

.family-image {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 8px 20px var(--shadow-light);
}

.family-image img {
  width: 100%;
  height: auto;
  display: block;
}

/* Owners Section */
.owners-section {
  padding: 60px 0;
  background-color: var(--lighter-gray);
}

.owner-content {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 40px;
}

.owner-text {
  flex: 1;
  min-width: 300px;
}

.owner-details {
  margin-top: 20px;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 6px 16px var(--shadow-light);
}

.owner-name {
  color: var(--text-color);
  font-size: 1.4rem;
  margin-bottom: 15px;
}

.owner-image {
  flex: 1;
  min-width: 300px;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 8px 20px var(--shadow-light);
}

.owner-image img {
  width: 100%;
  height: auto;
  display: block;
}

/* Vision & Mission Section */
.vision-mission-section {
  padding: 60px 0;
}

.vision-mission-content {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

.vision-box, .mission-box {
  flex: 1;
  min-width: 300px;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 6px 16px var(--shadow-light);
  background-color: var(--lighter-gray);
}

.vision-box h3, .mission-box h3 {
  color: var(--text-color);
  font-size: 1.6rem;
  margin-bottom: 20px;
  font-weight: 600;
}

.mission-box ul {
  padding-left: 20px;
}

.mission-box li {
  margin-bottom: 10px;
  position: relative;
}

.mission-box li::before {
  content: "•";
  color: var(--primary-color);
  font-weight: bold;
  display: inline-block;
  width: 1em;
  margin-left: -1em;
}

/* Products Section */
.products-scroll-container {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE and Edge */
  position: relative;
  padding: 10px 0;
}

.products-scroll-container::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}

.products-scroll-wrapper {
  display: flex;
  gap: 20px;
  transition: transform 0.3s ease;
  padding: 0 10px;
}

.product-card-wrapper {
  flex: 0 0 auto;
  width: 250px;
  transition: transform 0.3s ease;
}

.product-card {
  border-radius: 8px;
  overflow: hidden;
  border: 1px solid var(--border-color);
  box-shadow: 0 3px 10px var(--shadow-light);
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  height: 100%;
  max-width: 250px;
  margin: 0 auto;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 15px var(--shadow-medium);
}

.product-image-container {
  height: 200px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--lighter-gray);
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card:hover .product-image {
  transform: scale(1.05);
}

.product-desc {
  height: 40px;
  overflow: hidden;
  color: var(--text-secondary);
}

.product-buttons {
  gap: 5px;
}

.keranjang-btn {
  white-space: nowrap;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Testimonial Section */
.reviews-scroll-container {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE and Edge */
  position: relative;
  padding: 10px 0;
}

.reviews-scroll-container::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}

.reviews-scroll-wrapper {
  display: flex;
  gap: 20px;
  transition: transform 0.3s ease;
  padding: 0 10px;
}

.review-card-wrapper {
  flex: 0 0 auto;
  width: calc(100% / 3 - 20px);
  transition: transform 0.3s ease;
}

.testimonial-card {
  border-radius: 8px;
  overflow: hidden;
  border: 1px solid var(--border-color);
  box-shadow: 0 3px 10px var(--shadow-light);
  height: 100%;
}

.testimonial-text {
  max-height: none;
  overflow: visible;
}

/* Process Section */
.process-section {
  padding: 60px 0;
}

.process-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: var(--accent-color);
  color: var(--text-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1.2rem;
  transition: all 0.3s ease;
}

.active-process .process-circle {
  background-color: var(--primary-color);
  color: white;
  transform: scale(1.2);
}

.process-circle.pulse {
  animation: processHighlight 1.5s infinite;
}

@keyframes processHighlight {
  0% { box-shadow: 0 0 0 0 black; }
  70% { box-shadow: 0 0 0 15px black}
  100% { box-shadow: 0 0 0 0 }
}

/* Contact Section */
.custom-contact-box {
  background-color: var(--light-gray);
  border-radius: 20px;
  padding: 40px;
}

.custom-contact-img {
  max-width: 100%;
  border-radius: 12px;
  object-fit: cover;
  box-shadow: 0 4px 12px var(--shadow-light);
}

.map-container {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 12px var(--shadow-light);
  margin-bottom: 20px;
}

/* Button states and variants */
.btn-success {
  background-color: var(--success-color);
  color: white;
  padding: 10px 20px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background-color: #218838;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-outline-secondary {
  background-color: transparent;
  color: var(--text-color);
  padding: 10px 20px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 600;
  border: 2px solid var(--border-color);
  transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
  background-color: var(--light-gray);
  transform: translateY(-2px);
}

/* Navigation buttons */
.scroll-nav {
  position: absolute;
  width: 100%;
  top: 50%;
  left: 0;
  z-index: 2;
  transform: translateY(-50%);
  pointer-events: none;
}

.scroll-btn {
  position: absolute;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: white;
  border: none;
  box-shadow: 0 2px 10px var(--shadow-light);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  pointer-events: auto;
  opacity: 0.7;
}

.scroll-btn:hover {
  opacity: 1;
  transform: scale(1.1);
}

.scroll-btn.scroll-left,
.scroll-btn.reviews-scroll-left {
  left: -20px;
}

.scroll-btn.scroll-right,
.scroll-btn.reviews-scroll-right {
  right: -20px;
}

/* Pagination dots */
.scroll-indicator,
.reviews-scroll-indicator {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.scroll-dots,
.reviews-scroll-dots {
  display: flex;
  gap: 8px;
}

.dot {
  width: 8px;
  height: 8px;
  background-color: #ddd;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.dot.active {
  width: 16px;
  border-radius: 4px;
  background-color: var(--primary-color);
}

/* Custom culture image */
.custom-culture-image {
  max-width: 100%;
  border-radius: 50px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Loader */
.page-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #fff;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: opacity 0.5s ease;
}

.page-loader.loaded {
  opacity: 0;
  pointer-events: none;
}

.loader {
  width: 50px;
  height: 50px;
  border: 5px solid #f3f3f3;
  border-top: 5px solid var(--primary-color);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Custom cursor */
.custom-cursor {
  position: fixed;
  width: 10px;
  height: 10px;
  background-color: var(--primary-color);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9999;
  opacity: 0.5;
  transform: translate(-50%, -50%);
  transition: width 0.3s, height 0.3s, opacity 0.3s;
}

.custom-cursor.expanded {
  width: 30px;
  height: 30px;
  opacity: 0.2;
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .review-card-wrapper {
    width: calc(50% - 20px); /* Show 2 testimonials per view on tablets */
  }
}

@media (max-width: 768px) {
  .main-title {
    font-size: 2rem;
  }
  
  .subtitle {
    font-size: 1rem;
  }
  
  .owner-content, .vision-mission-content {
    flex-direction: column;
  }
  
  .section-title {
    font-size: 1.6rem;
  }
  
  .product-card-wrapper {
    width: 200px;
  }
  
  .review-card-wrapper {
    width: 80%; /* Show 1 testimonial per view on mobile */
  }
  
  .products-scroll-container,
  .reviews-scroll-container {
    padding: 0;
    margin: 0 -15px;
    width: calc(100% + 30px);
  }
  
  .products-scroll-wrapper,
  .reviews-scroll-wrapper {
    padding: 0 15px;
  }
  
  .custom-cursor {
    display: none;
  }
  
  body, a, button, .card, .process-item {
    cursor: auto;
  }
}

/* Animation on scroll */
.animate-on-scroll {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.animate-on-scroll.visible {
  opacity: 1;
  transform: translateY(0);
}
</style>









@endsection