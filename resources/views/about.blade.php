@extends('navbar')

@section('konten')


    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        {{-- <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
      </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row gy-4 align-items-center justify-content-between">
  
            <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
              <span class="about-meta"></span>
              <h2 class="about-title">📔Bringing Knowledge  Closer To You</h2>
              <p class="about-description"> MindSpark is here to provide unlimited access to literacy to everyone. With a collection of thousands of books, journals, articles and other digital resources, we are committed to being a bridge of knowledge for readers from various circles.</p>
  
              <div class="row feature-list-wrapper">
                <div class="col-md-12">
                  <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill"></i> Search books by category – Easily find your favorite books</li>
                    <li><i class="bi bi-check-circle-fill"></i> View detailed book information – Know the book description and availability</li>
                    <li><i class="bi bi-check-circle-fill"></i> Borrow & Return books – Manage borrowing easily through your account</li>
                  </ul>
                </div>
              
              </div>
            </div>
  
            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
              <div class="image-wrapper">
                <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                  <img src="assets/img/about-rak-buku.png" alt="Business Meeting" class="img-fluid main-image rounded-4">
                  <img src="assets/img/about-person-reading.png" alt="Team Discussion" class="img-fluid small-image rounded-4">
                </div>
                {{-- <div class="experience-badge floating">
                  <h3>15+ <span>Years</span></h3>
                  <p>Of experience in business service</p>
                </div> --}}
              </div>
            </div>
          </div>
  
        </div>
  
      </section><!-- /About Section -->
@endsection