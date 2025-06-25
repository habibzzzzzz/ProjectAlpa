@extends('auth.dashboard')

@section('content')
<section class="d-flex" style="
    background: url('/images/background2.png') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    padding-top: 40px;
    position: relative;
">
  <div class="container">
    <h2 class="mb-4 text-white text-center text-shadow"
        style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 2.2rem;"
        data-aos="fade-down" data-aos-duration="1000">
      Blog Seputar Pengiriman Barang
    </h2>

    {{ $posts->links() }}

    @foreach($posts as $post)
      <div class="card mb-4 shadow" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1200">
        <div class="card-body">
          <h4 class="card-title" style="font-family: 'Poppins', sans-serif;">{{ $post->title }}</h4>
          <p class="card-text">{{ $post->excerpt }}</p>
          <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endsection
