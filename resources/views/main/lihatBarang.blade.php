@extends('layout/template')

@section('content')
    <div class="row justify-content-center mt-5" style="overflow-x: auto;">
        <div class="col-md table-container">
            <table class="table table-striped table-bordered nowrap" id="tableList" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $BuatBarang)
                        @if ($BuatBarang->stok_barang > 0)
                            <tr>
                                <td>{{ $BuatBarang->kode_barang }}</td>
                                <td>{{ $BuatBarang->nama_barang }}</td>
                                <td>{{ $BuatBarang->harga_barang }}</td>
                                <td>{{ $BuatBarang->stok_barang }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="d-flex">

                                            <button class="btn btn-secondary tambahKeranjangBtn me-2"
                                                data-id="{{ $BuatBarang->kode_barang }}"
                                                data-nama="{{ $BuatBarang->nama_barang }}"
                                                data-harga="{{ $BuatBarang->harga_barang }}"
                                                data-stok="{{ $BuatBarang->stok_barang }}">Tambah Ke Keranjang</button>

                                            <form action="{{ route('editBarang', $BuatBarang->kode_barang) }}"
                                                method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-primary me-2">Edit</button>
                                            </form>

                                            <form action="{{ route('deleteBarang', $BuatBarang->kode_barang) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Hapus</button>
                                            </form>
                                        </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="keranjangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="keranjangModalLabel">Tambah Ke Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda ingin menambah <strong id="barangNama"></strong> ke keranjang?</p>
                    <div class="mb-3">
                        <label for="jumlahBarang" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang" min="1"
                            value="1">
                        <div class="invalid-feedback">Jumlah tidak boleh melebihi stok yang tersedia.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="tambahButton">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const keranjangModal = new bootstrap.Modal(document.getElementById('keranjangModal'), {});
            const barangNama = document.getElementById('barangNama');
            const jumlahBarangInput = document.getElementById('jumlahBarang');
            const tambahButton = document.getElementById('tambahButton');
            let stokBarang = 0;
            let kodeBarang = '';
            let hargaBarang = 0;

            document.querySelectorAll('.tambahKeranjangBtn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const barangName = e.target.getAttribute('data-nama');
                    stokBarang = e.target.getAttribute('data-stok');
                    kodeBarang = e.target.getAttribute('data-id');
                    hargaBarang = e.target.getAttribute('data-harga');
                    barangNama.textContent = barangName;
                    jumlahBarangInput.value = 1;
                    jumlahBarangInput.max = stokBarang;
                    jumlahBarangInput.classList.remove('is-invalid');
                    keranjangModal.show();
                });
            });

            tambahButton.addEventListener('click', () => {
                const jumlahBarang = parseInt(jumlahBarangInput.value, 10);
                if (jumlahBarang > stokBarang) {
                    jumlahBarangInput.classList.add('is-invalid');
                } else {
                    jumlahBarangInput.classList.remove('is-invalid');
                    const totalHarga = jumlahBarang * hargaBarang;

                    // Kirim data ke server
                    fetch("{{ route('addToKeranjang') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                kode_barang: kodeBarang,
                                nama_barang: barangNama.textContent,
                                harga_barang: hargaBarang,
                                jumlah_barang: jumlahBarang,
                                total_harga: totalHarga
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Redirect ke halaman keranjang
                                window.location.href = "{{ route('keranjang') }}";
                            }
                        });
                }
            });
        });
    </script>
@endsection
