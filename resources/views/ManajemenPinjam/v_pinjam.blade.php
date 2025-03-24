@extends('layouts.base')

@section('konten')
<div class="card filter-card">
    <!-- 🔍 Inquiry & Upload Section -->
    <div class="search-upload-wrapper" style="margin-bottom: 30px; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">

        <!-- Inquiry Title -->
        <h4 style="margin-bottom: 15px; font-weight: 400;">Managemen Pinjam Dokumen Nasabah</h4>

        <!-- Search Bar Group -->
        <div class="search-group" style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-end; margin-bottom: 25px;">

            <div>
                <label for="docName">No. Pin Nasabah</label>
                <input type="text" id="docName" placeholder="Masukkan No. Pin..." onkeyup="searchDocument()" class="form-control" />
            </div>

            <div>
                <label for="startDate">Tanggal Awal</label>
                <input type="date" id="startDate" value="2024-01-01" onchange="searchDocument()" class="form-control" />
            </div>

            <div>
                <label for="endDate">Tanggal Akhir</label>
                <input type="date" id="endDate" value="2024-02-01" onchange="searchDocument()" class="form-control" />
            </div>

            <div>
                <label for="search">Nama Dokumen</label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" id="search" placeholder="Nama dokumen..." onkeyup="searchDocument()" class="form-control" />
                    <button class="btn btn-primary" onclick="searchDocument()">Enter</button>
                </div>
            </div>
        </div>

        <!-- Upload Title -->
        <h4 style="margin-bottom: 10px; font-weight: 400;">Input Pinjam Dokumen</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Ajukan Pinjam Dokumen
        </button>
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Upload Dokumen Nasabah Aktif
        </button> --}}
          
    </div>

    <!-- 📋 Table Section -->
    <div style="overflow-x: auto;">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
              <div class="col">
                <h4>Tabel History Peminjaman</h4>
              </div>
              <div class="col text-end">
                <!-- Filter Dropdown Status -->
                <select id="statusFilter" class="form-select form-select-sm" style="width: auto; display: inline-block;" onchange="filterByStatus()">
                  <option value="">Semua Status</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Close">Close</option>
                </select>
              </div>
            </div>
          <table id="nasabahTable" class="display" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>No. Pin Nasabah</th>
                <th>Nama Nasabah</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Gudang</th>
                <th>Rak Aplikasi</th>
                <th>Tanggal Masuk</th>
                <th>Nama Dokumen</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="documentTable">
              <!-- Tambahkan baris data sebanyak yang dibutuhkan -->
              <!-- Contoh data -->
              <tr>
                <td>1</td>
                <td>123456</td>
                <td>Ahmad Pratama</td>
                <td>Jakarta</td>
                <td>Aktif</td>
                <td>Gudang A</td>
                <td>Rak 3B</td>
                <td>2024-01-15</td>
                <td>DOK_0011000123001</td>
                <td>
                  <button class="view-btn">View</button>
                  <button class="edit-btn">Edit</button>
                  <button class="delete-btn">Batal</button>
                </td>
              </tr>
              <!-- Tambahkan <tr> lainnya sesuai kebutuhan -->
            </tbody>
          </table>
      
          <!-- Pagination controls -->
          <div id="pagination" style="margin-top: 20px; display: flex; gap: 8px; align-items: center;"></div>
        </div>
    </div>
</div>

<!-- 🗂️ Modal Upload Dokumen -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Dokumen Nasabah Aktif</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form id="dokumenForm">
          <div class="mb-3">
            <label for="noPin" class="form-label text-start fw-semibold">No. Pin Nasabah</label>
            <input type="text" class="form-control" id="noPin" name="noPin" placeholder="Masukkan No. Pin" required />
          </div>

          <div class="mb-3">
            <label for="nama" class="form-label text-start fw-semibold">Nama Nasabah</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required />
          </div>

          <div class="mb-3">
            <label for="branch" class="form-label text-start fw-semibold">Branch</label>
            <select class="form-select" id="branch" name="branch" required>
              <option value="" disabled selected>Pilih Branch</option>
              <option value="Jakarta">Jakarta</option>
              <option value="Bandung">Bandung</option>
              <option value="Surabaya">Surabaya</option>
              <option value="Semarang">Semarang</option>
              <!-- Tambahkan branch lainnya sesuai kebutuhan -->
            </select>
          </div>
          

          <div class="mb-3">
            <label for="status" class="form-label text-start fw-semibold">Status</label>
            <select id="status" name="status" class="form-select" required>
              <option value="Aktif">Aktif</option>
              <option value="Close">Close</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="Gudang" class="form-label text-start fw-semibold">Gudang</label>
            <select class="form-select" name="Gudang" id="Gudang" required>
              <option value="" disabled selected>Pilih Gudang</option>
              <option value="Gudang A">Gudang A</option>
              <option value="Gudang B">Gudang B</option>
              <option value="Gudang C">Gudang C</option>
              <!-- Tambahkan opsi lain sesuai kebutuhan -->
            </select>
          </div>          

          <div class="mb-3">
            <label for="Rak_Aplikasi" class="form-label text-start fw-semibold">Rak Aplikasi</label>
            <input type="text" class="form-control" name="rak_aplikasi" id="Rak_Aplikasi"
              placeholder="Masukkan Rak Aplikasi" required />
          </div>
          <div class="mb-3">
            <label for="tanggal_masuk" class="form-label text-start fw-semibold">Tanggal Masuk</label>
            <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" required />
          </div>

          <div class="mb-3">
            <label for="fileUpload" class="form-label text-start fw-semibold">Unggah Dokumen (PDF/DOC)</label>
            <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".pdf,.doc,.docx"
              required />
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="modal-footer d-flex flex-column gap-2">
        <button type="submit" form="dokumenForm" class="btn btn-success w-100">Simpan</button>
        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<script>
    const rowsPerPage = 5;
    const table = document.getElementById("documentTable");
    const rows = table.querySelectorAll("tr");
    const pagination = document.getElementById("pagination");
    let currentPage = 1;
  
    function displayPage(page) {
      const totalPages = Math.ceil(rows.length / rowsPerPage);
      currentPage = Math.max(1, Math.min(page, totalPages));
  
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
  
      rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? "" : "none";
      });
  
      renderPagination(totalPages);
    }
  
    function renderPagination(totalPages) {
      pagination.innerHTML = "";
  
      // Prev button
      const prevBtn = document.createElement("button");
      prevBtn.innerText = "Previous";
      prevBtn.className = "pagination-button";
      prevBtn.disabled = currentPage === 1;
      prevBtn.onclick = () => displayPage(currentPage - 1);
      pagination.appendChild(prevBtn);
  
      // Page number buttons
      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.className = "pagination-button";
        if (i === currentPage) btn.classList.add("active");
        btn.onclick = () => displayPage(i);
        pagination.appendChild(btn);
      }
  
      // Next button
      const nextBtn = document.createElement("button");
      nextBtn.innerText = "Next";
      nextBtn.className = "pagination-button";
      nextBtn.disabled = currentPage === totalPages;
      nextBtn.onclick = () => displayPage(currentPage + 1);
      pagination.appendChild(nextBtn);
    }
  
    document.addEventListener("DOMContentLoaded", () => {
      displayPage(1);
    });
  </script>
  
@endsection
