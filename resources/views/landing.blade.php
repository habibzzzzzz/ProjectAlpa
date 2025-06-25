<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GO BORIR - Landing Page</title>
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>

  
<nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(90deg, #ffffff 0%, #c4f1f9 50%, #00b4d8 100%);">
<div class="container">
  <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height: 40px; width: auto;">
    <span style="font-family: 'Poppins', sans-serif;">GO BORIR</span>
  </a>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="#home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#profil">Tentang</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn btn-outline-primary btn-sm ms-2" href="{{ route('login') }}">Login</a>
      </li>
    </ul>
  </div>
</div>

</nav>


<section id="home" class="py-5 text-center text-white" 
  style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
         url('/images/background.png') center center / cover no-repeat; 
         min-height: 100vh; display: flex; align-items: center;">
  <div class="container">
    <h1 class="display-4 fw-bold" 
        data-aos="fade-down" 
        data-aos-duration="1200">
      Selamat Datang di GO BORIR
    </h1>
    <p class="lead" 
       data-aos="fade-up" 
       data-aos-delay="200" 
       data-aos-duration="1000">
      Solusi Cerdas Kirim Barang - Cepat, Aman, Tepat Waktu
    </p>
  </div>
</section>

  </div>
</section>
<section id="profil" class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold">Sekilas Profil BORIR</h2>
      <p class="text-muted">BERANI BERKARIR bersama BORIR</p>
    </div>
    
    <div class="row align-items-center">
      <div class="col-md-6" data-aos="fade-right">
        <h4 class="fw-semibold">Apa itu BORIR?</h4>
        <p>
          <strong>BORIR</strong> atau <em>Bonceng Kurir</em> adalah badan usaha yang bergerak di bidang layanan jasa pengiriman dan penitipan barang. 
          BORIR hadir sebagai solusi kebutuhan masyarakat dalam memindahkan barang dari satu lokasi ke lokasi lainnya secara cepat, aman, dan terpercaya.
        </p>
      </div>
      <div class="col-md-6 text-center" data-aos="zoom-in">
      <img src="{{ asset('images/logo1.png') }}" alt="Profil BORIR" class="img-fluid rounded-circle shadow w-50">
      </div>
    </div>

    <section id="profil-borir" class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <h2 class="text-center fw-bold mb-5">Sekilas Profil BORIR</h2>
    <div class="row mb-4">
      <div class="col-md-12">
        <p class="lead text-center">
          <strong>BORIR</strong> (Bonceng Kurir) adalah badan usaha yang bergerak di bidang pelayanan jasa dan pengiriman barang. BORIR hadir untuk memenuhi kebutuhan masyarakat dalam memindahkan atau mengirimkan barang dari satu tempat ke tempat lainnya secara aman dan cepat.
        </p>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-6">
        <h4 class="fw-bold">Visi</h4>
        <p>
          Menjadikan BORIR sebagai perusahaan jasa pengiriman dan jasa titip terbaik serta berkualitas di Indonesia.
        </p>
      </div>
      <div class="col-md-6">
        <h4 class="fw-bold">Misi</h4>
        <ul>
          <li>Memberikan layanan jasa terbaik dan terintegrasi kepada seluruh masyarakat di Indonesia.</li>
          <li>Menjadi akses layanan terbaik bagi semua pelanggan dalam pengiriman dan jasa titip.</li>
          <li>Meningkatkan kesejahteraan kurir serta mendukung tanggung jawab sosial terhadap masyarakat.</li>
        </ul>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col text-center">
        <h5 class="fst-italic">Slogan: <span class="fw-bold">BERANI BERKARIR</span></h5>
      </div>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-md-12">
        <h4 class="fw-bold text-center mb-4">Keunggulan BORIR</h4>
        <div class="row text-center">
          <div class="col-md-4 mb-3">
            <div class="p-3 border rounded shadow-sm h-100">Kurir Profesional</div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 border rounded shadow-sm h-100">Pick Up Langsung Kirim</div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 border rounded shadow-sm h-100">Amanah dan Terpercaya</div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 border rounded shadow-sm h-100">Cashback & Voucher</div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="p-3 border rounded shadow-sm h-100">Ciri Khas: Styrofoam Packaging</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // durasi animasi (ms)
    once: true      // hanya animasi sekali saat scroll
  });
</script>

</body>
</html>
