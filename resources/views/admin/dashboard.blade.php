<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - GO BORIR</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    
  .nav-link {
  transition: all 0.3s ease;
  border-radius: 8px;
}
.nav-link:hover {
  background-color: #dff6fd;
  transform: translateX(5px);
  font-weight: 500;
}

.nav-link.active {
  background-color: #1a73e8 !important;
  color: white !important;
}

    body {
      background: linear-gradient(135deg, #f8fbff, #7bc2e0);
      min-height: 100vh;
      color: rgb(0, 0, 0);
      font-family: 'Roboto', sans-serif;
    }
    .nav-link.active {
      background-color: #1a73e8 !important;
      color: #fff !important;
    }
    .sidebar {
      background-color: rgba(90, 225, 255, 0.995);
      min-height: 100vh;
    }
    .content-section {
      display: none;
    }
    .content-section.active {
      display: block;
    }
    .table th, .table td {
      color: rgb(0, 0, 0);
      vertical-align: middle;
    }
    .card {
      background-color: rgba(255, 255, 255, 0.718);
      border: none;
    }
    .logout-link {
      transition: all 0.3s ease;
      border-radius: 8px;
      background: none;
      border: none;
      padding: 0;
      text-align: left;
      color: #dc3545 !important;
      font-weight: 500;
      display: flex;
      align-items: center;
      width: 100%;
      cursor: pointer;
    }
    .logout-link:hover {
      background-color: #f8d7da;
      color: #a71d2a !important;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
<!-- Sidebar -->
<div class="col-md-3 sidebar d-flex flex-column align-items-start p-4 text-dark shadow-sm position-fixed start-0 top-0 min-vh-100" style="background: linear-gradient(180deg, #ffffff 0%, #d4f1ff 40%, #c2e9fb 100%);"
><img src="{{ asset('images/logo1.png') }}" alt="Logo" class="mb-3 mx-auto d-block" width="80">
    <h4 class="fw-bold text-primary mb-4 w-100 text-center">Admin</h4>
  <a class="nav-link active w-100 mb-2 d-flex align-items-center" onclick="showTab(event, 'history')" href="#">
    <i class="bi bi-clock-history me-2"></i> Riwayat Pemesanan
  </a>
  <a class="nav-link w-100 mb-2 d-flex align-items-center" onclick="showTab(event, 'status')" href="#">
    <i class="bi bi-truck me-2"></i> Status Pengiriman
  </a>
  <a class="nav-link w-100 mb-2 d-flex align-items-center" onclick="showTab(event, 'users')" href="#">
    <i class="bi bi-people-fill me-2"></i> Pengguna
  </a>
  <a class="nav-link w-100 mb-2 d-flex align-items-center" onclick="showTab(event, 'report')" href="#">
    <i class="bi bi-graph-up me-2"></i> Laporan
  </a>
  <hr class="w-100 my-3">
  <form method="POST" action="{{ route('logout') }}" class="w-100">
    @csrf
    <button type="submit" class="logout-link text-danger w-100 d-flex align-items-center" style="background:none;border:none;padding:0;text-align:left;">
      <i class="bi bi-box-arrow-right me-2"></i> Logout
    </button>
  </form>
</div>



      <!-- Content -->
   <div class="col-md-9 offset-md-3 p-4">
<div class="text-center mb-4" style="font-family: 'Poppins', sans-serif;">
  
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

        <!-- Riwayat -->
        <section id="history" class="content-section active">
          <div class="card p-4 mb-4">
            <h4>Riwayat Pemesanan (Status: Diterima)</h4>
            <p>Menampilkan data riwayat pemesanan yang telah selesai (status: diterima).</p>
            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead class="table-primary text-dark">
                  <tr>
                    <th>Id Pesanan</th>
                    <th>Nama Pengirim</th>
                    <th>Nama Penerima</th>
                    <th>Alamat Tujuan</th>
                    <th>Layanan</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Bukti Transfer</th>
                    <th>Tanggal Selesai</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($riwayatPesanan as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_pengirim }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->alamat_tujuan }}</td>
                    <td>{{ ucfirst($item->layanan) }}</td>
                    <td>Rp{{ number_format((int) $item->harga) }}</td>
                    <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                    <td>{{ ucfirst($item->status_pembayaran) }}</td>
                    <td>
                        @if($item->bukti_transfer)
                            @php
                                $filename = basename($item->bukti_transfer);
                                $imagePath = route('bukti.transfer.show', $filename);
                            @endphp
                            <button type="button" class="btn btn-sm btn-info" onclick="showBuktiTransfer('{{ $imagePath }}')">
                                <i class="bi bi-image"></i> Lihat Bukti
                            </button>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ date('d-m-Y H:i', strtotime($item->updated_at)) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Status -->
        <section id="status" class="content-section">
          <div class="card p-4 mb-4">
            <h4>Status Pengiriman</h4>
            <p>Kelola status pengiriman barang secara real-time.</p>
            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead class="table-primary text-dark">
                  <tr>
                    <th>Id pesanan</th>
                    <th>Nama Pengirim</th>
                    <th>Nama Penerima</th>
                    <th>Alamat Tujuan</th>
                    <th>Layanan</th>
                    <th>Metode Pembayaran</th>
                    <th>Harga</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pengiriman</th>
                    <th>Bukti Transfer</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pemesanan as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_pengirim }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->alamat_tujuan }}</td>
                    <td>{{ ucfirst($item->layanan) }}</td>
                    <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                    <td>Rp{{ number_format((int) $item->harga) }}</td>
                    <td>{{ ucfirst($item->status_pembayaran) }}</td>
                    <td>{{ ucfirst($item->status_pengiriman ?? 'menunggu konfirmasi') }}</td>
                    <td>
                        @if($item->bukti_transfer)
                            @php
                                $filename = basename($item->bukti_transfer);
                                $imagePath = route('bukti.transfer.show', $filename);
                            @endphp
                            <button type="button" class="btn btn-sm btn-info" onclick="showBuktiTransfer('{{ $imagePath }}')">
                                <i class="bi bi-image"></i> Lihat Bukti
                            </button>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('status.update', ['pemesanan_id' => $item->id]) }}">
                            @csrf
                            <select name="status" class="form-select form-select-sm mb-2" aria-label="Ubah status pengiriman">
                                @foreach (\App\Models\StatusPengiriman::$STATUS as $key => $label)
                                    <option value="{{ $key }}" {{ $item->status_pengiriman == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Pengguna -->
        <section id="users" class="content-section">
          <div class="card p-4 mb-4">
            <h4>Data Pengguna</h4>
            <p>Menampilkan daftar pengguna dan informasi terkait.</p>
            
            <!-- Filter dan Pencarian -->
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" id="searchUser" class="form-control" placeholder="Cari nama atau email...">
              </div>
              <div class="col-md-3">
                <select id="filterRole" class="form-select">
                  <option value="">Semua Role</option>
                  <option value="admin">Admin</option>
                  <option value="kurir">Kurir</option>
                  <option value="customer">Customer</option>
                </select>
              </div>
              <div class="col-md-3">
                <select id="filterStatus" class="form-select">
                  <option value="">Semua Status</option>
                  <option value="aktif">Aktif</option>
                  <option value="nonaktif">Nonaktif</option>
                </select>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary w-100" onclick="resetFilter()">
                  <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead class="table-primary text-dark">
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Tanggal Registrasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'kurir' ? 'warning' : 'primary') }}">
                        {{ ucfirst($user->role) }}
                      </span>
                    </td>
                    <td>
                      <span class="badge bg-{{ $user->status === 'aktif' ? 'success' : 'secondary' }}">
                        {{ ucfirst($user->status) }}
                      </span>
                    </td>
                    <td>{{ date('d-m-Y H:i', strtotime($user->created_at)) }}</td>
                    <td>
                      <!-- <button type="button" class="btn btn-sm btn-info" onclick="showUserDetail({{ $user->id }})">
                        <i class="bi bi-eye"></i> Detail
                      </button> -->
                      <button type="button" class="btn btn-sm btn-warning" onclick="editUser({{ $user->id }})">
                        <i class="bi bi-pencil"></i> Edit
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Laporan -->
        <section id="report" class="content-section">
          <div class="card p-4 mb-4">
            <h4><i class="bi bi-file-earmark-text me-2"></i>Laporan Riwayat Pemesanan</h4>
            <p>Export laporan riwayat pemesanan yang telah selesai (status: diterima) dalam format PDF.</p>
            
            <div class="row">
              <div class="col-md-8">
                <form action="{{ route('admin.export.laporan') }}" method="POST" id="exportForm">
                  @csrf
                  <div class="row">
                    <div class="col-md-5">
                      <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-success w-100" id="exportBtn">
                          <i class="bi bi-download me-1"></i> Export PDF
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-4">
                <div class="card bg-light">
                  <div class="card-body">
                    <h6 class="card-title"><i class="bi bi-info-circle me-2"></i>Informasi</h6>
                    <ul class="list-unstyled mb-0">
                      <li><small>• Laporan hanya menampilkan pesanan dengan status "diterima"</small></li>
                      <li><small>• Periode berdasarkan tanggal selesai pengiriman</small></li>
                      <li><small>• Format file: PDF</small></li>
                      <li><small>• Nama file: laporan-riwayat-pemesanan-[tanggal].pdf</small></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-4">
              <h6><i class="bi bi-clock-history me-2"></i>Riwayat Export Terakhir</h6>
              <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Belum ada riwayat export. Silakan pilih periode tanggal dan klik "Export PDF" untuk membuat laporan pertama.
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Modal Edit User -->
  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editUserForm" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="editUserName" class="form-label">Nama</label>
              <input type="text" class="form-control" id="editUserName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="editUserEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="editUserEmail" name="email" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showTab(e, id) {
      e.preventDefault();
      document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
      e.target.classList.add('active');

      document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(id).classList.add('active');
    }

    function logout() {
      alert("Anda akan logout. (Logout function belum diimplementasi)");
    }

    function showBuktiTransfer(imageUrl) {
      // Buat modal dinamis
      const modal = document.createElement('div');
      modal.className = 'modal fade';
      modal.id = 'buktiTransferModal';
      modal.innerHTML = `
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Bukti Transfer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
              <img src="${imageUrl}" class="img-fluid" alt="Bukti Transfer" style="max-height: 500px;">
            </div>
            <div class="modal-footer">
              <a href="${imageUrl}" target="_blank" class="btn btn-primary">Buka di Tab Baru</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      `;
      
      // Hapus modal lama jika ada
      const oldModal = document.getElementById('buktiTransferModal');
      if (oldModal) {
        oldModal.remove();
      }
      
      // Tambahkan modal ke body
      document.body.appendChild(modal);
      
      // Tampilkan modal
      const bootstrapModal = new bootstrap.Modal(modal);
      bootstrapModal.show();
      
      // Hapus modal dari DOM setelah ditutup
      modal.addEventListener('hidden.bs.modal', function () {
        modal.remove();
      });
    }

    function showUserDetail(userId) {
      // Untuk sementara tampilkan alert, bisa dikembangkan dengan AJAX
      alert('Fitur detail user untuk ID: ' + userId + ' akan dikembangkan lebih lanjut.');
    }

    function editUser(userId) {
      // Fetch user data via AJAX
      fetch(`/admin/user/${userId}`)
        .then(response => response.json())
        .then(user => {
          // Set form action
          document.getElementById('editUserForm').action = `/admin/user/${userId}/edit`;
          
          // Fill form fields
          document.getElementById('editUserName').value = user.name;
          document.getElementById('editUserEmail').value = user.email;
          
          // Show modal
          const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
          modal.show();
        })
        .catch(error => {
          console.error('Error fetching user data:', error);
          alert('Gagal mengambil data user. Silakan coba lagi.');
        });
    }

    // Fungsi pencarian dan filter untuk tabel pengguna
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchUser');
      const filterRole = document.getElementById('filterRole');
      const filterStatus = document.getElementById('filterStatus');
      const userTable = document.querySelector('#users tbody');

      function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const roleFilter = filterRole.value.toLowerCase();
        const statusFilter = filterStatus.value.toLowerCase();
        const rows = userTable.querySelectorAll('tr');

        rows.forEach(row => {
          const name = row.cells[1].textContent.toLowerCase();
          const email = row.cells[2].textContent.toLowerCase();
          const role = row.cells[3].textContent.toLowerCase();
          const status = row.cells[4].textContent.toLowerCase();

          const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
          const matchesRole = !roleFilter || role.includes(roleFilter);
          const matchesStatus = !statusFilter || status.includes(statusFilter);

          if (matchesSearch && matchesRole && matchesStatus) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      }

      searchInput.addEventListener('input', filterUsers);
      filterRole.addEventListener('change', filterUsers);
      filterStatus.addEventListener('change', filterUsers);
    });

    function resetFilter() {
      document.getElementById('searchUser').value = '';
      document.getElementById('filterRole').value = '';
      document.getElementById('filterStatus').value = '';
      
      // Tampilkan semua baris
      const rows = document.querySelectorAll('#users tbody tr');
      rows.forEach(row => {
        row.style.display = '';
      });
    }

    // Validasi form export laporan
    document.addEventListener('DOMContentLoaded', function() {
      const exportForm = document.getElementById('exportForm');
      const exportBtn = document.getElementById('exportBtn');
      const startDate = document.getElementById('start_date');
      const endDate = document.getElementById('end_date');

      // Set default dates (last 30 days)
      const today = new Date();
      const thirtyDaysAgo = new Date(today.getTime() - (30 * 24 * 60 * 60 * 1000));
      
      startDate.value = thirtyDaysAgo.toISOString().split('T')[0];
      endDate.value = today.toISOString().split('T')[0];

      exportForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi tanggal
        if (!startDate.value || !endDate.value) {
          alert('Silakan pilih tanggal mulai dan tanggal akhir!');
          return;
        }

        if (new Date(startDate.value) > new Date(endDate.value)) {
          alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir!');
          return;
        }

        // Show loading state
        exportBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Generating...';
        exportBtn.disabled = true;

        // Submit form
        exportForm.submit();
      });

      // Reset button state after page reload
      if (exportBtn) {
        exportBtn.innerHTML = '<i class="bi bi-download me-1"></i> Export PDF';
        exportBtn.disabled = false;
      }
    });
  </script>
</body>
</html>
