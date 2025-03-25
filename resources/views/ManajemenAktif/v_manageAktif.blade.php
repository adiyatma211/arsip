@extends('layouts.base')

@section('konten')
    <div class="card filter-card">
        <!-- 🔍 Inquiry & Upload Section -->
        <div class="search-upload-wrapper"
            style="margin-bottom: 30px; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">

            <!-- Inquiry Title -->
            <h4 style="margin-bottom: 15px; font-weight: 400;">Inquiry Dokumen Nasabah Aktif</h4>

            <!-- Search Bar Group -->
            <div class="search-group"
                style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-end; margin-bottom: 25px;">
                <div>
                    <label for="docName">No. Pin Nasabah</label>
                    <input type="text" id="docName" placeholder="Masukkan No. Pin..." onkeyup="searchDocument()"
                        class="form-control" />
                </div>

                <div>
                    <label for="startDate">Tanggal Awal</label>
                    <input type="date" id="startDate" value="2024-01-01" onchange="searchDocument()"
                        class="form-control" />
                </div>

                <div>
                    <label for="endDate">Tanggal Akhir</label>
                    <input type="date" id="endDate" value="2024-02-01" onchange="searchDocument()"
                        class="form-control" />
                </div>

                <div>
                    <label for="search">Nama Dokumen</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="search" placeholder="Nama dokumen..." onkeyup="searchDocument()"
                            class="form-control" />
                        <button class="btn btn-primary" onclick="searchDocument()">Enter</button>
                    </div>
                </div>
            </div>

            <!-- Upload Title -->
            <h4 style="margin-bottom: 10px; font-weight: 400;">Upload Dokumen</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Upload Dokumen Nasabah Aktif
            </button>
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Upload Dokumen Nasabah Aktif
        </button> --}}

        </div>

        <!-- 📋 Table Section -->
        <div style="overflow-x: auto;">
            <div class="container-fluid">
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
                        @foreach ($getDataAktif as $a)
                            <tr>
                                <td>{{ $loop->iteration ?? 'kosong' }}</td>
                                <td>{{ $a->noAccount ?? 'kosong' }}</td>
                                <td>{{ $a->custname ?? 'kosong' }}</td>
                                <td>{{ $a->branch_id ?? 'kosong' }}</td>
                                <td>{{ $a->account_type ?? 'kosong' }}</td>
                                <td>{{ $a->gudang_id ?? 'kosong' }}</td>
                                <td>{{ $a->rak_id ?? 'kosong' }}</td>
                                <td>{{ $a->created_at ?? 'kosong' }}</td>
                                <td>{{ $a->dokumen_aktif ?? 'kosong' }}</td>
                                <td>
                                    <button class="view-btn">View</button>
                                    <button class="edit-btn">Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Tambahkan <tr> lainnya sesuai kebutuhan -->
                    </tbody>
                </table>

                <!-- Pagination controls -->
                <div id="pagination" style="margin-top: 20px; display: flex; gap: 8px; align-items: center;"></div>
            </div>
        </div>

    </div>

    <!-- 🗂️ Modal Upload Dokumen -->
    <!-- Modal Upload Dokumen -->
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
                    <!-- Pastikan form memiliki id dan berada di dalam modal-body -->
                    <form id="dokumenForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="noPin" class="form-label text-start fw-semibold">No. Pin Nasabah</label>
                            <input type="text" class="form-control" id="noPin" name="noAccount"
                                placeholder="Masukkan No. Pin" required />
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label text-start fw-semibold">Nama Nasabah</label>
                            <input type="text" class="form-control" id="nama" name="custname"
                                placeholder="Masukkan Nama" required />
                        </div>

                        <div class="mb-3">
                            <label for="branch" class="form-label text-start fw-semibold">Branch</label>
                            <select class="form-select" id="branch" name="branch_id" required>
                                <option value="" disabled selected>Pilih Branch</option>
                                <option value="001">Jakarta</option>
                                <option value="002">Bandung</option>
                                <option value="003">Surabaya</option>
                                <option value="004">Semarang</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label text-start fw-semibold">Status</label>
                            <select id="status" name="account_type" class="form-select" required>
                                <option value="0">Aktif</option>
                                <option value="1">Close</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Gudang" class="form-label text-start fw-semibold">Gudang</label>
                            <select class="form-select" name="gudang_id" id="Gudang" required>
                                <option value="" disabled selected>Pilih Gudang</option>
                                <option value="Gudang A">Gudang A</option>
                                <option value="Gudang B">Gudang B</option>
                                <option value="Gudang C">Gudang C</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Rak_Aplikasi" class="form-label text-start fw-semibold">Rak Aplikasi</label>
                            <input type="text" class="form-control" name="rak_id" id="Rak_Aplikasi"
                                placeholder="Masukkan Rak Aplikasi" required />
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label text-start fw-semibold">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" />
                        </div>

                        <div class="mb-3">
                            <label for="fileUpload" class="form-label text-start fw-semibold">Unggah Dokumen
                                (PDF/DOC)</label>
                            <input type="file" class="form-control" id="fileUpload" name="dokumen_aktif"
                                accept=".pdf,.doc,.docx" required />
                        </div>

                        <!-- Footer: Tombol submit langsung berada di dalam form -->
                        <div class="modal-footer d-flex flex-column gap-2">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
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
    <script>
        $(document).ready(function() {
            $('#dokumenForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: '/ManageAktif/store',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Reset form
                                $('#dokumenForm')[0].reset();
                                // Tutup modal
                                const modal = bootstrap.Modal.getInstance(document
                                    .getElementById('staticBackdrop'));
                                modal.hide();
                                // Reload page
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        let message = 'Terjadi kesalahan.';

                        if (res && res.errors) {
                            message = Object.values(res.errors).flat().join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: message
                        });
                    }
                });
            });
        });
    </script>
@endsection
