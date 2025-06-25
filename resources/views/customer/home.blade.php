@extends('auth.dashboard')

@section('content')

<section class="d-flex align-items-center" style="
    background: url('/images/background.png') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    position: relative;
"><div class="container" style="transform: translateX(-100px);">
  <div class="row justify-content-start">
    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1200">
      <div class="card shadow p-4 mt-5 rounded" style="background: rgba(255, 255, 255, 0.95); border: none;">
        <div class="text-center">
          <img src="{{ asset('images/kurir1.png') }}" class="img-fluid mb-3 logo-float-rotate" style="max-height: 200px;" alt="Logo">

            <h5 class="mb-3" style="
              font-size: 26px;
              background: linear-gradient(to right, #0066ff, #00ccff);
              -webkit-background-clip: text;
              -webkit-text-fill-color: transparent;
              font-weight: 600;
            ">
              Tumbuhkan Bisnismu Bersama BORIR
            </h5>

            <p class="text-muted">Solusi cerdas kirim barang!<br>GO BORIR hadir untuk Anda yang butuh layanan cepat, aman, dan tepat waktu.</p>

            <div class="container py-4" data-aos="fade-up" data-aos-delay="300">
              <div class="row justify-content-center text-center">
                <div class="col-md-12 shadow p-4 rounded">
                  <h4 class="mb-2" style="font-weight: bold;">Hubungi Kami</h4>

                  <div class="mb-3">
                    <a href="https://wa.me/6289503116862" target="_blank" class="me-3">
                      <img src="{{ asset('images/WhatsApp.png') }}" width="30" alt="WhatsApp">
                    </a>
                    <a href="https://instagram.com/goborir" target="_blank" class="me-3">
                      <img src="{{ asset('images/Instagram.png') }}" width="30" alt="Instagram">
                    </a>
                    <a href="mailto:goborir@email.com" class="me-3">
                      <img src="{{ asset('images/Gmail.png') }}" width="30" alt="Email">
                    </a>
                  </div>

                  <hr>

                  <h5 class="mb-3">Beri Penilaian</h5>
                  <div class="rating mb-3">
                    <span class="fs-4 text-warning">★ ★ ★ ★ ☆</span><br>
                    <small class="text-muted">4.0 dari 5.0</small>
                  </div>

                  <button class="btn btn-outline-primary btn-sm">Kirim Penilaian</button>
                </div>
              </div>
            </div>

          </div> <!-- text-center -->
        </div> <!-- card -->
      </div> <!-- col -->
    </div> <!-- row -->
  </div> <!-- container -->
</section>

@endsection
