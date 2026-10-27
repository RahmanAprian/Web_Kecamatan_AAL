<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $statistik = [
            'penduduk' => '98.542',
            'kelurahan' => '4',
            'rt_rw' => '38 RT / 8 RW',
            'luas_wilayah' => '9,92 km²',
        ];

        $kelurahan = [
            [
                'nama' => 'Alang-Alang Lebar',
                'icon' => 'fa-city',
                'deskripsi' => 'Wilayah pusat pemerintahan Kecamatan Alang-Alang Lebar.',
                'luas' => '2,50 km²',
                'penduduk' => '25.000+',
            ],
            [
                'nama' => 'Karya Baru',
                'icon' => 'fa-house',
                'deskripsi' => 'Wilayah permukiman dan kawasan masyarakat berkembang.',
                'luas' => '2,40 km²',
                'penduduk' => '24.000+',
            ],
            [
                'nama' => 'Talang Kelapa',
                'icon' => 'fa-building',
                'deskripsi' => 'Wilayah strategis dengan aktivitas perdagangan dan jasa.',
                'luas' => '2,70 km²',
                'penduduk' => '27.000+',
            ],
            [
                'nama' => 'Srijaya',
                'icon' => 'fa-tree-city',
                'deskripsi' => 'Wilayah permukiman dengan potensi sosial masyarakat.',
                'luas' => '2,32 km²',
                'penduduk' => '22.000+',
            ],
        ];

        $layanan = [
            [
                'kode' => 'L-01',
                'waktu' => '3-7 Hari Kerja',
                'judul' => 'Pelayanan Kartu Keluarga',
                'deskripsi' => 'Pelayanan administrasi penerbitan dan perubahan Kartu Keluarga.',
                'syarat' => ['Kartu Keluarga lama', 'KTP elektronik', 'Surat pengantar kelurahan'],
            ],
            [
                'kode' => 'L-02',
                'waktu' => '3-7 Hari Kerja',
                'judul' => 'Pelayanan KTP Elektronik',
                'deskripsi' => 'Pelayanan perekaman dan penerbitan KTP elektronik warga.',
                'syarat' => ['Kartu Keluarga', 'Surat pengantar kelurahan', 'Usia minimal 17 tahun'],
            ],
            [
                'kode' => 'L-03',
                'waktu' => '1-3 Hari Kerja',
                'judul' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Pelayanan surat keterangan domisili bagi warga kecamatan.',
                'syarat' => ['KTP', 'Kartu Keluarga', 'Surat pengantar RT/RW'],
            ],
            [
                'kode' => 'L-04',
                'waktu' => '1-3 Hari Kerja',
                'judul' => 'Surat Keterangan Usaha',
                'deskripsi' => 'Pelayanan surat keterangan usaha untuk kebutuhan administrasi warga.',
                'syarat' => ['KTP', 'Kartu Keluarga', 'Surat pengantar kelurahan'],
            ],
        ];

        $berita = [
            [
                'gambar' => 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?w=800',
                'kategori' => 'Pemerintahan',
                'tanggal' => '20 Oktober 2026',
                'judul' => 'Pelayanan Publik Kecamatan Alang-Alang Lebar',
                'ringkasan' => 'Informasi pelayanan publik untuk seluruh masyarakat Kecamatan Alang-Alang Lebar.',
            ],
            [
                'gambar' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800',
                'kategori' => 'Kegiatan',
                'tanggal' => '18 Oktober 2026',
                'judul' => 'Kegiatan Kemasyarakatan Kecamatan',
                'ringkasan' => 'Kegiatan pembangunan dan kemasyarakatan terus dilaksanakan bersama warga.',
            ],
            [
                'gambar' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=800',
                'kategori' => 'Informasi',
                'tanggal' => '15 Oktober 2026',
                'judul' => 'Informasi Layanan Administrasi',
                'ringkasan' => 'Masyarakat dapat mengakses informasi layanan administrasi melalui portal ini.',
            ],
        ];

        return view('kecamatan.landing', compact(
            'statistik',
            'kelurahan',
            'layanan',
            'berita'
        ));
    }

    public function aspirasi(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        $validated['status'] = 'Menunggu';

        Aspirasi::create($validated);

        return redirect()
            ->route('kecamatan.home')
            ->with('success_aspirasi', 'Laporan atau aspirasi berhasil dikirim.');
    }
}