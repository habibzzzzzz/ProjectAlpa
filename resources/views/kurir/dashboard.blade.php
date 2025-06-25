<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Kurir - GO BORIR</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(135deg, #4a90e2, #0a3d62);
      min-height: 100vh;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .nav-link.active {
      background-color: #1a73e8 !important;
      color: #fff !important;
    }
    .sidebar {
      background: linear-gradient(180deg, #ffffff 0%, #d4f1ff 40%, #c2e9fb 100%);
      min-height: 100vh;
    }
    .table th, .table td {
      color: #000;
      vertical-align: middle;
    }
    .card {
      background-color: rgba(255, 255, 255, 0.15);
      border: none;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column align-items-start p-3 text-dark shadow-sm bg-white position-fixed start-0 top-0 min-vh-100">

        <h4 class="fw-bold text-primary mb-4 w-100 text-center">Kurir</h4>
        <a class="nav-link active w-100 mb-2 d-flex align-items-center" href="#">
          <i class="bi bi-box-seam me-2"></i> Status Pengiriman
        </a>
        <hr class="w-100 my-3">
        <form method="POST" action="{{ route('logout') }}" class="w-100">
          @csrf
          <button type="submit" class="nav-link text-danger w-100 d-flex align-items-center" style="background:none;border:none;padding:0;text-align:left;">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </button>
        </form>
      </div>

      <!-- Content -->
      <div class="col-md-9 offset-md-2 p-4">
        <div class="text-center mb-4">
          <h3 class="fw-bold text-light">Dashboard Kurir</h3>
          <p class="text-light">Kelola dan pantau status pengiriman barang.</p>
        </div>

        <!-- Tabel Status Pengiriman -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card p-4 mb-1">
          <h4 class="text-white">Status Pengiriman</h4>
          <div class="table-responsive">
          <table class="table table-hover table-bordered table-nowrap">
              <thead class="table-primary text-dark">
               <tr>
                    <th>No</th>
                    <th>Nama Pengirim</th>
                    <th>Nama Penerima</th>
                    <th>Alamat Tujuan</th>
                    <th>Layanan</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pengiriman</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              </tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_pengirim }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->alamat_tujuan }}</td>
                    <td>{{ ucfirst($item->layanan) }}</td>
                    <td>Rp{{ number_format($item->harga) }}</td>
                    <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                    <td>{{ ucfirst($item->status_pembayaran) }}</td>
                    <td>{{ ucfirst($item->status_pengiriman ?? 'menunggu konfirmasi') }}</td>
                    <td>
                        <form method="POST" action="{{ route('status.update', ['pemesanan_id' => $item->id]) }}">
                            @csrf
                            <select name="status" aria-label="Ubah status pengiriman">
                                @foreach (\App\Models\StatusPengiriman::$STATUS as $key => $label)
                                    <option value="{{ $key }}" {{ $item->status_pengiriman == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function logout() {
      alert("Anda akan logout. (Logout function belum diimplementasi)");
    }
  </script>
</body>
</html>