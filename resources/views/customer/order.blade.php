@extends('auth.dashboard')

@section('content')
 <div id="order" class="panel">
    <div class="order-form-container">

      @if (session('success'))
          <!-- Audio Elemen -->
    <audio id="notifSound" autoplay hidden>
        <source src="{{ asset('sounds/notifikasi.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
  <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        {{ session('success') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Ada masalah dengan input kamu:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="card shadow p-4">
      <h2 class="text-center mb-4">Pemesanan Pengiriman</h2>

      <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data" id="form-pemesanan">
        @csrf
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama" class="form-label">Nama Pengirim:</label>
            <input type="text" id="nama" name="nama_pengirim" class="form-control" required placeholder="Masukkan nama anda" value="{{ old('nama_pengirim') }}">
          </div>
          <div class="col-md-6">
            <label for="nohp" class="form-label">No. HP:</label>
            <input type="text" id="nohp" name="no_hp" class="form-control" required placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
          </div>
        </div>

        <div class="mb-3">
          <label for="alamatJemput" class="form-label">Alamat Penjemputan:</label>
          <input type="text" id="alamatJemput" name="alamat_jemput" class="form-control" required placeholder="Masukkan alamat lengkap" value="{{ old('alamat_jemput') }}">
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="pembayaran" class="form-label">Metode Pembayaran:</label>
            <select id="pembayaran" name="metode_pembayaran" class="form-select" required>
              <option value="">-- Pilih Metode Pembayaran --</option>
              <option value="cod" {{ old('metode_pembayaran') == 'cod' ? 'selected' : '' }}>COD (Bayar di Tempat)</option>
              <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank / DANA</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="wilayah" class="form-label">Wilayah:</label>
            <select id="wilayah" name="wilayah" class="form-select" required>
              <option value="">-- Pilih Wilayah --</option>
              <option value="AlangAlangLebar" {{ old('wilayah') == 'AlangAlangLebar' ? 'selected' : '' }}>Alang Alang Lebar</option>
                <option value="BukitKecil" {{ old('wilayah') == 'BukitKecil' ? 'selected' : '' }}>Bukit Kecil</option>
                <option value="IlirBaratII" {{ old('wilayah') == 'IlirBaratII' ? 'selected' : '' }}>Ilir Barat II</option>
                <option value="IlirBaratI" {{ old('wilayah') == 'IlirBaratI' ? 'selected' : '' }}>Ilir Barat I</option>
                <option value="IlirTimurII" {{ old('wilayah') == 'IlirTimurII' ? 'selected' : '' }}>Ilir Timur II</option>
                <option value="IlirTimurI" {{ old('wilayah') == 'IlirTimurI' ? 'selected' : '' }}>Ilir Timur I</option>
                <option value="IlirTimurIII" {{ old('wilayah') == 'IlirTimurIII' ? 'selected' : '' }}>Ilir Timur III</option>
                <option value="Jakabaring" {{ old('wilayah') == 'Jakabaring' ? 'selected' : '' }}>Jakabaring</option>
                <option value="Kalidoni" {{ old('wilayah') == 'Kalidoni' ? 'selected' : '' }}>Kalidoni</option>
                <option value="Kemuning" {{ old('wilayah') == 'Kemuning' ? 'selected' : '' }}>Kemuning</option>
                <option value="kertapati" {{ old('wilayah') == 'kertapati' ? 'selected' : '' }}>kertapati</option>
                <option value="Plaju" {{ old('wilayah') == 'Plaju' ? 'selected' : '' }}>Plaju</option>
                <option value="Sako" {{ old('wilayah') == 'Sako' ? 'selected' : '' }}>Sako</option>
                <option value="SeberangUluII" {{ old('wilayah') == 'SeberangUluII' ? 'selected' : '' }}>Seberang Ulu II</option>
                <option value="SeberangUluI" {{ old('wilayah') == 'SeberangUluI' ? 'selected' : '' }}>Seberang Ulu I</option>
                <option value="SematangBorang" {{ old('wilayah') == 'SematangBorang' ? 'selected' : '' }}>Sematang Borang</option>
                <option value="Sukarami" {{ old('wilayah') == 'Sukarami' ? 'selected' : '' }}>Sukarami</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="layanan" class="form-label">Jenis Layanan:</label>
            <select id="layanan" name="layanan" class="form-select" required>
              <option value="">-- Pilih Layanan --</option>
              <option value="express" {{ old('layanan') == 'express' ? 'selected' : '' }}>Express</option>
              <option value="reguler" {{ old('layanan') == 'reguler' ? 'selected' : '' }}>Reguler</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="harga" class="form-label">Harga:</label>
            <input type="text" id="harga" name="harga" class="form-control" readonly placeholder="Rp0" value="{{ old('harga') }}">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama_penerima" class="form-label">Nama Penerima:</label>
            <input type="text" id="nama_penerima" name="nama_penerima" class="form-control" required value="{{ old('nama_penerima') }}">
          </div>
          <div class="col-md-6">
            <label for="alamat_tujuan" class="form-label">Alamat Tujuan:</label>
            <input type="text" id="alamat_tujuan" name="alamat_tujuan" class="form-control" required value="{{ old('alamat_tujuan') }}">
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>

        <!-- Kolom Tambahan untuk Transfer -->
<div id="transfer-instruction" style="display: none; margin-top: 16px; padding: 16px; background-color: #fef9c3; border-radius: 8px; font-weight: 500; color: #92400e;">
  <p>Silakan transfer ke rekening berikut:</p>
  <ul style="margin-top: 8px;">
    <li>Bank BCA - 8435531225 Muhammad Alfarizi </li>
    <li>DANA - 089503116862 Muhammad Alfarizi</li>
     <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
          <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*">
          <small class="form-text text-muted">Upload bukti transfer kamu disini setelah melakukan pembayaran.</small>
  </ul>
      </form>
    </div>
  </div>
</div>

 <script>
        window.addEventListener('DOMContentLoaded', function () {
            const sound = document.getElementById('notifSound');
            if (sound) {
                sound.play().catch((e) => {
                    console.log('Auto-play mungkin diblokir oleh browser:', e);
                });
            }
        });
    </script>

<script>
   const metodeSelect = document.getElementById('pembayaran');
  const transferInstruction = document.getElementById('transfer-instruction');

  metodeSelect.addEventListener('change', function() {
    if (this.value === 'transfer') {
      transferInstruction.style.display = 'block';
    } else {
      transferInstruction.style.display = 'none';
    }
  });
</script>
         

<script>
   const metodePembayaran = document.getElementById('pembayaran');
    const transferSection = document.getElementById('transfer-section');

    function toggleTransferSection() {
        if (metodePembayaran.value === 'transfer') {
            transferSection.style.display = 'block';
        } else {
            transferSection.style.display = 'none';
        }
    }

    metodePembayaran.addEventListener('change', toggleTransferSection);

    // Untuk memastikan langsung tampil jika sebelumnya sudah pilih transfer
    window.addEventListener('load', toggleTransferSection);


        // untuk mengubah harga sesuai wilayah
  const hargaData = {
    AlangAlangLebar: {
      express: 15000,
      reguler: 10000
    },
    BukitKecil : {
      express: 20000,
      reguler: 12000
    },
    IlirBaratII: {
      express: 15000,
      reguler: 10000
    },
    IlirBaratI : {
      express: 20000,
      reguler: 12000
    },
    IlirBaratII : {
      express: 15000,
      reguler: 10000
    },
    IlirTimurII : {
      express: 20000,
      reguler: 12000
    },
    IlirTimurI: {
      express: 15000,
      reguler: 10000
    },
    IlirTimurIII : {
      express: 20000,
      reguler: 12000
    },
    Jakabaring: {
      express: 15000,
      reguler: 10000
    },
    Kalidoni : {
      express: 20000,
      reguler: 12000
    },
    Kemuning : {
      express: 15000,
      reguler: 10000
    },
    Kertapati: {
      express: 20000,
      reguler: 12000
    },
    Plaju: {
      express: 15000,
      reguler: 10000
    },
    Sako : {
      express: 20000,
      reguler: 12000
    },
    SeberangUluII: {
      express: 15000,
      reguler: 10000
    },
    SeberangUluI : {
      express: 20000,
      reguler: 12000
    },
    SematangBorang: {
      express: 15000,
      reguler: 10000
    },
    Sukarami : {
      express: 20000,
      reguler: 12000
    },
    // Tambahkan wilayah lain jika perlu

    
  };

function updateHarga() {
    const wilayah = document.getElementById('wilayah').value;
    const layanan = document.getElementById('layanan').value;

    if (hargaData[wilayah] && hargaData[wilayah][layanan]) {
        const harga = hargaData[wilayah][layanan];
       document.getElementById('harga').value = `Rp${harga.toLocaleString('id-ID')}`;

    } else {
        document.getElementById('harga').value = 'Rp0';
    }
}

document.getElementById('wilayah').addEventListener('change', updateHarga);
document.getElementById('layanan').addEventListener('change', updateHarga);

// Tambahkan ini untuk update harga otomatis saat halaman pertama kali dibuka
window.addEventListener('load', updateHarga);


</script>
@endsection
