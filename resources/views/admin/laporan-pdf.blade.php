<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Riwayat Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #1a73e8;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .info-section h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 16px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
        }
        .info-label {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background-color: #1a73e8;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GO BORIR</h1>
        <p>Laporan Riwayat Pemesanan</p>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="info-section">
        <h3>Ringkasan Laporan</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Total Pesanan:</span>
                <span>{{ $totalPesanan }} pesanan</span>
            </div>
            <div class="info-item">
                <span class="info-label">Total Pendapatan:</span>
                <span>Rp{{ number_format($totalPendapatan) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Periode Laporan:</span>
                <span>{{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span>Selesai (Diterima)</span>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>Alamat Tujuan</th>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatPesanan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_pengirim }}</td>
                <td>{{ $item->nama_penerima }}</td>
                <td>{{ $item->alamat_tujuan }}</td>
                <td>{{ ucfirst($item->layanan) }}</td>
                <td>Rp{{ number_format($item->harga) }}</td>
                <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                <td>{{ ucfirst($item->status_pembayaran) }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($item->tanggal_selesai)) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align: center;">Tidak ada data untuk periode yang dipilih</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total-section">
        <p>Total Pendapatan: Rp{{ number_format($totalPendapatan) }}</p>
        <p>Total Pesanan: {{ $totalPesanan }} pesanan</p>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem GO BORIR</p>
        <p>© {{ date('Y') }} GO BORIR - All rights reserved</p>
    </div>
</body>
</html> 