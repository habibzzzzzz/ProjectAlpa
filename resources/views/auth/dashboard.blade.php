<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GO BORIR - Dashboard Customer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>

  .fade-transition {
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
  }

  body.fade-in {
    opacity: 1 !important;
  }

    body {
      background: linear-gradient(to bottom right, #ffffff, #f0f3f8);
      font-family: 'Poppins', sans-serif;
    }
    .navbar-brand img {
      height: 40px;
    }
    .content {
      padding: 40px 20px;
    }


  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(to right, #ffffff, #4bb4ff9f);">

   <div class="container">
  <a class="navbar-brand d-flex align-items-center gap-2" href="/customer/home">
    <img src="{{ asset('images/logo-login.png') }}" alt="Logo GO BORIR" style="height: 60px; width: auto;">
    <h1 class="mb-0" style="font-size: 28px; font-weight: bold; background: linear-gradient(90deg, #0066ff, #00ccff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
      GO BORIR
    </h1>

      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/customer/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/customer/order">Order Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/customer/history">Order History</a>
          </li>
          <li class="nav-item">
        <a class="nav-link" href="/customer/blog/index">Blog</a>
        
<li class="nav-item">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-link btn btn-link">Logout</button>
  </form>
</li>



        </ul>
      </div>
    </div>
  </nav>

 
</div>
    @yield('content')
  </div>

 

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.add('fade-in');
  });

  document.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('javascript')) return;

      e.preventDefault();
      document.body.classList.remove('fade-in');
      document.body.classList.add('fade-transition');

      setTimeout(function () {
        window.location.href = href;
      }, 300);
    });
  });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


</body>
</html>
