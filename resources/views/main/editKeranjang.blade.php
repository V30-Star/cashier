@extends('layout/template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="mb-3 text-center">Edit Barang dalam Keranjang</h4>
                <hr class="my-4">

                <form class="needs-validation" method="POST" action="{{ route('updateKeranjang', $barang['kode_barang']) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                            value="{{ $barang['kode_barang'] }}" disabled style="width: 100%;">
                    </div>

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                            value="{{ $barang['nama_barang'] }}" disabled style="width: 100%;">
                    </div>

                    <div class="mb-3">
                        <label for="harga_barang" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control" id="harga_barang" name="harga_barang"
                            value="{{ $barang['harga_barang'] }}" style="width: 100%;">
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                            value="{{ $barang['jumlah_barang'] }}" min="1" style="width: 100%;">
                    </div>

                    <div class="mb-3">
                        <label for="total_harga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                            value="{{ $barang['harga_barang'] * $barang['jumlah_barang'] }}" disabled style="width: 100%;">
                    </div>

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Lanjutkan Untuk Edit Data</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaBarangInput = document.getElementById('harga_barang');
            const jumlahBarangInput = document.getElementById('jumlah_barang');
            const totalHargaInput = document.getElementById('total_harga');

            function updateTotalHarga() {
                const hargaBarang = parseFloat(hargaBarangInput.value);
                const jumlahBarang = parseInt(jumlahBarangInput.value);
                const totalHarga = hargaBarang * jumlahBarang;
                totalHargaInput.value = totalHarga;
            }

            hargaBarangInput.addEventListener('input', updateTotalHarga);
            jumlahBarangInput.addEventListener('input', updateTotalHarga);
        });
    </script>
@endsection
