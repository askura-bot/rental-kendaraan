<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => '62812345678']
        );

        Setting::updateOrCreate(
            ['key' => 'terms_and_conditions'],
            ['value' => 'Syarat dan Ketentuan Penyewaan Kendaraan:

1. PENYEWA WAJIB:
   - Memiliki SIM yang masih berlaku
   - Berusia minimal 21 tahun
   - Menyediakan kartu identitas (KTP/Paspor)
   - Memberikan uang jaminan/deposit

2. PEMBAYARAN:
   - Pembayaran dilakukan di muka atau saat pengambilan
   - Diterima tunai, transfer bank, atau e-wallet
   - Tidak ada pengembalian untuk pembatalan kurang dari 24 jam

3. TANGGUNG JAWAB PENYEWA:
   - Menjaga kondisi kendaraan dengan baik
   - Bertanggung jawab atas kerusakan atau kehilangan
   - Mengisi bensin sebelum mengembalikan
   - Mengembalikan kendaraan tepat waktu

4. BIAYA TAMBAHAN:
   - Keterlambatan pengembalian: Rp 50.000/jam
   - Kehilangan/Kerusakan: Sesuai penilaian damage
   - Denda tilang/pelanggaran: Ditanggung penyewa

5. ASURANSI:
   - Asuransi dasar sudah termasuk
   - Asuransi tambahan tersedia dengan biaya tambahan

6. PENGECUALIAN:
   - Kami tidak bertanggung jawab untuk barang berharga di dalam kendaraan
   - Gunakan kendaraan hanya untuk keperluan legal

Dengan menyetujui ini, Anda telah membaca dan memahami seluruh syarat dan ketentuan.']
        );
    }
}
