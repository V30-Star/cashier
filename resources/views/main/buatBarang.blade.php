@extends('layout/template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="mb-3 text-center">Form Data</h4>

                <hr class="my-4">

                <form class="needs-validation" method="POST" action="{{ route('buatBarang.action') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" style="width: 100%;">
                        <div class="invalid-feedback">
                            Kode Barang perlu di isi
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" style="width: 100%;">
                        <div class="invalid-feedback">
                            Nama Barang perlu di isi
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="harga_barang" class="form-label">Harga Barang</label>
                        <input type="text" class="form-control" id="harga_barang" name="harga_barang"
                            style="width: 100%;">
                        <div class="invalid-feedback">
                            Harga Barang perlu di isi
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="stok_barang" class="form-label">Stok Barang</label>
                        <input type="text" class="form-control" id="stok_barang" name="stok_barang"
                            style="width: 100%;">
                        <div class="invalid-feedback">
                            Stok Barang perlu di isi
                        </div>
                    </div>

                    <br>

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Lanjutkan Untuk Save Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
