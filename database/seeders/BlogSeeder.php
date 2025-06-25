<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void

    
    {
    
         Blog::create([
            'title' => 'Tren dan Tantangan dalam Industri Pengiriman Barang di Indonesia',
            'slug' => Str::slug('Tren dan Tantangan dalam Industri Pengiriman Barang di Indonesia'),
            'excerpt' => 'Industri pengiriman barang di Indonesia menghadapi berbagai perubahan besar seiring perkembangan teknologi dan e-commerce.',
            'content' => '
                <p>Industri pengiriman barang di Indonesia tengah mengalami transformasi signifikan yang didorong oleh pertumbuhan e-commerce, inovasi teknologi, serta perubahan perilaku konsumen.</p>

                <p>Perusahaan logistik kini dituntut untuk menyediakan layanan yang lebih cepat, transparan, dan fleksibel guna memenuhi ekspektasi pelanggan yang semakin tinggi. Tantangan utama yang dihadapi meliputi efisiensi operasional, keterbatasan infrastruktur, serta kebutuhan akan sistem pelacakan yang real-time.</p>

                <p>Menurut <strong>BPS Logistics</strong>, investasi pada digitalisasi dan otomatisasi menjadi kunci untuk bersaing di tengah ketatnya persaingan pasar pengiriman barang saat ini. Hal ini termasuk penggunaan sistem manajemen gudang, aplikasi pelacakan pengiriman, serta integrasi data untuk meningkatkan visibilitas rantai pasok.</p>

                <p>Artikel lengkap dapat dibaca di <a href="https://bps-logistics.com/2024/07/19/tren-dan-tantangan-dalam-industri-pengiriman-barang-di-indonesia/" target="_blank">situs resmi BPS Logistics</a>.</p>
            '
        ]);

        Blog::create([
            'title' => 'Regulasi Baru dalam Pengiriman Barang: Panduan Lengkap untuk Konsumen',
            'slug' => Str::slug('Regulasi Baru dalam Pengiriman Barang: Panduan Lengkap untuk Konsumen'),
            'excerpt' => 'Simak panduan terbaru mengenai peraturan pengiriman barang yang wajib diketahui oleh konsumen',
            'content' => '<p>Dalam beberapa tahun terakhir, pemerintah Indonesia terus memperbarui regulasi terkait pengiriman barang untuk meningkatkan transparansi dan keamanan dalam sektor logistik.</p>

        <p>Regulasi baru ini mencakup ketentuan tentang pelabelan barang, penggunaan jasa ekspedisi resmi, dan kewajiban pelaporan bagi perusahaan logistik. Konsumen kini diharapkan lebih waspada dan memahami hak serta kewajibannya dalam proses pengiriman barang.</p>

        <p>Hal penting lain adalah kewajiban pengecekan status barang secara berkala dan memastikan barang yang dikirim tidak termasuk dalam kategori yang dilarang atau dibatasi pengirimannya.</p>

        <p>Artikel lengkap dapat dibaca di <a href="https://autokirim.com/blog/regulasi-baru-dalam-pengiriman-barang-panduan-lengkap-untuk-konsumen" target="_blank">situs resmi Autokirim</a>.</p>
    '
        ]);
        
        Blog::create([
            'title' => 'Tips Mengirim Paket yang Aman Supaya Tidak Mudah Rusak',
            'slug' => Str::slug('Tips Mengirim Paket yang Aman Supaya Tidak Mudah Rusak'),
            'excerpt' => 'Agar paket sampai dengan aman dan tepat waktu, simak tips penting yang perlu Anda lakukan sebelum mengirim barang.',
            'content' => '
        <p>Mengirim paket bukan hanya soal membungkus dan menyerahkan ke ekspedisi. Anda perlu memahami cara pengemasan yang tepat, memilih jasa pengiriman yang terpercaya, serta menyertakan informasi penerima secara lengkap.</p>

        <p>Beberapa tips penting sebelum mengirim paket: pastikan barang dibungkus dengan aman, gunakan bubble wrap untuk barang mudah pecah, dan jangan lupa tempelkan label alamat yang jelas dan benar.</p>

        <p>Selalu simpan nomor resi pengiriman untuk pelacakan dan pilih layanan pengiriman dengan fitur tracking agar bisa memantau pergerakan barang.</p>

        <p>Artikel lengkap bisa dibaca di <a href="https://www.bhinneka.com/blog/tips-mengirim-paket/" target="_blank">situs resmi Bhinneka</a>.</p>
    '
]);
    }
}
