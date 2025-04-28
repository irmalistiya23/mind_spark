@extends('navbar')

@section('konten')
<!DOCTYPE html>
<html lang="en">
<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
              <div class="company-badge mb-4">
                <i class="bi bi-gear-fill me-2"></i>
                Bekerja untuk kesuksesan anda
              </div>

              <h1 class="mb-4">
                Selamat Datang di <br>
                <span class="accent-text">MindSpark</span>
              </h1>

              <p class="mb-4 mb-md-5">
                Jelajahi koleksi buku, jurnal, dan artikel dari berbagai bidang sains.
              </p>

              <div class="hero-buttons">
                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Mulai</a>
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-link mt-2 mt-sm-0 glightbox">
                  <i class="bi bi-play-circle me-1"></i>
                  Putar Video
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/book-hero.png" alt="Hero Image" class="img-fluid">

            </div>
          </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-trophy"></i>
              </div>
              <div class="stat-content">
                <h4>300+</h4>
                <p class="mb-0">Buku yang tersedia di Perpustakaan</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-briefcase"></i>
              </div>
              <div class="stat-content">
                <h4>10+</h4>
                <p class="mb-0">Jumlah Kategori</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-graph-up"></i>
              </div>
              <div class="stat-content">
                <h4>1000+</h4>
                <p class="mb-0">Jumlah Ulasan dan Rating</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-award"></i>
              </div>
              <div class="stat-content">
                <h4>1000+</h4>
                <p class="mb-0">Jumlah Pengguna</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->
 </main>
</body>
</html>
@endsection