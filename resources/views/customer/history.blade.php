@extends('auth.dashboard')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

@section('content')
<div id="history" class="panel">

  <div class="text-center py-10" style="font-family: 'Poppins', sans-serif;" data-aos="fade-down" data-aos-duration="1000">
    <h2 class="text-3xl font-semibold text-gray-800 mb-4">Riwayat Pemesanan</h2>
    <p class="text-gray-600 text-lg">Tidak ada pesanan yang ditemukan.</p>
  </div>

  {{-- Tampilkan tabel --}}
  <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1200">
    <table style="width:100%; border-collapse: collapse;" class="shadow rounded">
      <thead>
        <tr style="background-color: #f3f4f6;">
          <th>No</th>
          <th>Nama Penerima</th>
          <th>Alamat Tujuan</th>
          <th>Layanan</th>
          <th>Harga</th>
          <th>Status Pembayaran</th>
          <th>Status Pengiriman</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data ?? [] as $index => $item)
        <tr style="text-align: center;" data-aos="fade-up" data-aos-delay="{{ 200 + $index * 100 }}" data-aos-duration="1000">
          <td>{{ $index + 1 }}</td>
          <td>{{ $item->nama_penerima }}</td>
          <td>{{ $item->alamat_tujuan }}</td>
          <td>{{ ucfirst($item->layanan) }}</td>
          <td>Rp{{ number_format($item->harga) }}</td>
          <td>{{ ucfirst($item->status_pembayaran) }}</td>
          <td>{{ ucfirst($item->status_pengiriman ?? 'menunggu konfirmasi') }}</td>
          <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection
