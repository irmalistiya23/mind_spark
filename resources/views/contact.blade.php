@extends('navbar')

@section('konten')
    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          {{-- <h2>Contact</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
        </div><!-- End Section Title -->
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
              <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                <h3>Contact Info</h3>
                <p>Got any questions or need assistance? Feel free to reach out to us!</p>
  
                <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                  <div class="content">
                    <h4>Library Location</h4>
                    <p>SMKN 11 Bandung</p>
                    <p> Jl. Budhi Cilember, Sukaraja, Cicendo, Sukaraja, Cicendo, Kota Bandung, Jawa Barat 40153, Indonesia</p>
                  </div>
                </div>
  
                <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                  <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                  </div>
                  <div class="content">
                    <h4>Phone Number</h4>
                    <p>+1 5589 55488 55</p>
                    <p>+1 6678 254445 41</p>
                  </div>
                </div>

                <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                  <div class="icon-box">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div class="content">
                    <h4>Operating Hours </h4>
                    <p>Monday - Friday: 7:00 AM – 3:00 PM</p>
                    <p>Saturday – Sunday: Closed </p>

                  </div>
                </div>
  
                <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                  <div class="icon-box">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div class="content">
                    <h4>Email Address</h4>
                    <p>mindsparkinfo@gmail.com</p>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-lg-7">
              <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                <h3>Get In Touch</h3>
                <p>Feel free to reach out to us by filling out the form below. Our team will respond to your inquiry promptly.</p>
  
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                  <div class="row gy-4">
  
                    <div class="col-md-6">
                      <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                    </div>
  
                    <div class="col-md-6 ">
                      <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                    </div>
  
                    <div class="col-12">
                      <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                    </div>
  
                    <div class="col-12">
                      <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                    </div>
  
                    <div class="col-12 text-center">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
  
                      <button type="submit" class="btn">Send Message</button>
                    </div>
  
                  </div>
                </form>
  
              </div>
            </div>
  
          </div>
  
        </div>
  
      </section><!-- /Contact Section -->

@endsection
  