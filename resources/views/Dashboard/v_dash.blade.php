@extends('layouts.base')

@section('konten')

    {{-- ==== Statistik Card ==== --}}
    <div class="stats-container" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 20px;">
        <div class="stats-card aktif">
            Total Berkas Aktif <br>
            <span id="nasabahAktif">0</span>
        </div>
        <div class="stats-card lunas">
            Total Berkas Lunas <br>
            <span id="nasabahLunas">0</span>
        </div>
        <div class="stats-card total-nasabah">
            Total Nasabah <br>
            <span id="totalNasabah">0</span>
        </div>
        <div class="stats-card dipinjam">
            Total Dipinjam <br>
            <span id="totalDipinjam">0</span>
        </div>
    </div>

    {{-- ==== 2 Kolom Section ==== --}}
    <div class="dashboard-sections" style="display: flex; gap: 20px; margin-top: 20px;">

        {{-- 🔹 Section Kiri: Tabel Dokumen --}}
        <div class="section-kiri" style="flex: 2; display: flex; flex-direction: column; gap: 20px;">

            {{-- 📄 Card 1: Tabel Dokumen --}}
            <div style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h4>Daftar Dokumen</h4>
                <div class="container-fluid">
                    <div class="search-group">
                        <div>
                            <label for="docName">No. Pin Nasabah</label>
                            <input type="text" id="docName" placeholder="Masukkan No. Pin..." onkeyup="searchDocument()" />
                        </div>
                        <div>
                            <label for="startDate">Tanggal Awal</label>
                            <input type="date" id="startDate" value="2024-01-01" onchange="searchDocument()" />
                        </div>
                        <div>
                            <label for="endDate">Tanggal Akhir</label>
                            <input type="date" id="endDate" value="2024-02-01" onchange="searchDocument()" />
                        </div>
                        <div>
                            <label for="search">Nama Dokumen</label>
                            <div class="search-input-group">
                                <input type="text" id="search" placeholder="Nama dokumen..." onkeyup="searchDocument()" />
                                <button class="enter-btn" onclick="searchDocument()">
                                    Enter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f0f0f0;">
                            <th style="padding: 8px;">No</th>
                            <th style="padding: 8px;">Nama Nasabah</th>
                            <th style="padding: 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 8px;">1</td>
                            <td style="padding: 8px;">Contoh Nasabah</td>
                            <td style="padding: 8px;">Aktif</td>
                        </tr>
                        {{-- Tambahkan baris lainnya --}}
                    </tbody>
                </table>
            </div>

            {{-- 🕓 Card 2: Perubahan Terakhir --}}
            <div style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h4 style="margin-bottom: 15px;">Perubahan Terakhir</h4>
                <ul style="list-style: none; padding-left: 0; margin: 0;">
                    <li style="margin-bottom: 8px;">
                        <strong>Nasabah A</strong> - Status diubah menjadi <em>Aktif</em><br>
                        <small>23 Maret 2025, 14:50 WIB</small>
                    </li>
                    <li style="margin-bottom: 8px;">
                        <strong>Nasabah B</strong> - Dokumen diunggah ulang<br>
                        <small>23 Maret 2025, 14:30 WIB</small>
                    </li>
                </ul>
            </div>

        </div>

        {{-- 🔸 Section Kanan: Permintaan Peminjaman --}}
        <div class="section-kanan" style="flex: 1;">
            <div style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px;">
                <h4 style="margin-bottom: 10px;">Permintaan Peminjaman Belum Approve</h4>
        
                <!-- Request List -->
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <!-- Request 1 -->
                    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <strong>Request #1</strong>
                        <p>Permintaan pinjam dokumen dari Nasabah A.</p>
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <button style="padding: 6px 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Approve
                            </button>
                            <button style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Reject
                            </button>
                        </div>
                    </div>
        
                    <!-- Request 2 -->
                    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                        <strong>Request #2</strong>
                        <p>Permintaan pinjam dokumen dari Nasabah B.</p>
                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                            <button style="padding: 6px 12px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Approve
                            </button>
                            <button style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>
        
                <!-- Tombol Lihat Semua -->
                <div style="text-align: right; margin-top: 10px;">
                    <a href="#" style="padding: 8px 16px; background-color: #007bff; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 500;">
                        Lihat Seluruh Pengajuan
                    </a>
                </div>
            </div>
        </div>
        
        

    </div>

    {{-- ==== Modal Input Dokumen ==== --}}
    <div id="uploadModal" class="modal">
        <div class="form-container">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Input Dokumen</h2>
            <form id="dokumenForm">
                <div class="form-group">
                    <label for="noPin">No. Pin Nasabah</label>
                    <input type="text" id="noPin" placeholder="Masukkan No. Pin" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Nasabah</label>
                    <input type="text" id="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="branch">Branch</label>
                    <input type="text" id="branch" placeholder="Masukkan Branch" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileUpload">Unggah Dokumen (PDF/DOC)</label>
                    <input type="file" id="fileUpload" accept=".pdf,.doc,.docx" required>
                </div>
                <div id="filePreviewContainer" style="margin-top: 10px; display: none;">
                    <iframe id="filePreview" width="100%" height="400px"></iframe>
                </div>
                <button type="submit" class="submit-btn">Simpan</button>
            </form>
        </div>
    </div>

@endsection
