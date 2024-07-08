@extends('layout/template')

@section('content')
    <div class="row justify-content-center mt-5" style="overflow-x: auto;">
        <div class="col-md table-container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-striped table-bordered nowrap" id="keranjangTable" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0;
                    @endphp
                    @foreach ($keranjang as $item)
                        <tr>
                            <td>{{ $item['kode_barang'] }}</td>
                            <td>{{ $item['nama_barang'] }}</td>
                            <td>{{ $item['harga_barang'] }}</td>
                            <td>{{ $item['jumlah_barang'] }}</td>
                            <td>{{ $item['total_harga'] }}</td>
                            <td>
                                <form action="{{ route('editBarang', $item['kode_barang']) }}" method="GET"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary me-2">Edit</button>
                                </form>
                                <form action="{{ route('removeFromKeranjang', $item['kode_barang']) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                            @php
                                $grandTotal += $item['total_harga'];
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"><strong>Grand Total:</strong></td>
                        <td>{{ $grandTotal }}</td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-success mt-3" id="checkoutButton">Checkout</button>

            <div class="row mt-3">
                <div class="col">
                    <form action="{{ route('hapusSemuaBarang') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus semua data?')">Hapus
                            Semua
                            Barang</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Konfirmasi Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="buyerName" class="form-label">Nama Pembeli</label>
                            <input type="text" class="form-control" id="buyerName" name="buyerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="purchaseDate" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="purchaseDate" name="purchaseDate" required>
                        </div>
                        <p>Apakah Anda yakin ingin melakukan checkout?</p>
                        <table class="table table-striped table-bordered" id="checkoutItemsTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan diisi melalui JavaScript -->
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmCheckoutBtn">Ya, Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const checkoutButton = document.getElementById('checkoutButton');
            const checkoutItemsTableBody = document.querySelector('#checkoutItemsTable tbody');
            const confirmCheckoutBtn = document.getElementById('confirmCheckoutBtn');
            const checkoutForm = document.getElementById('checkoutForm');
            const keranjangTable = document.getElementById('keranjangTable');

            checkoutButton.addEventListener('click', () => {
                const keranjangRows = keranjangTable.querySelectorAll('tbody tr');
                if (keranjangRows.length > 0) {
                    checkoutItemsTableBody.innerHTML = ''; // Clear previous items
                    keranjangRows.forEach(row => {
                        const cells = row.cells;
                        const newRow = checkoutItemsTableBody.insertRow();
                        for (let i = 0; i < cells.length - 1; i++) {
                            const newCell = newRow.insertCell();
                            newCell.textContent = cells[i].textContent;
                        }
                    });
                    const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                    checkoutModal.show();
                } else {
                    const errorMessage = document.createElement('div');
                    errorMessage.classList.add('alert', 'alert-danger', 'mt-3');
                    errorMessage.textContent = 'Keranjang kosong. Tidak ada barang untuk di-checkout.';
                    const tableContainer = document.querySelector('.table-container');
                    tableContainer.insertBefore(errorMessage, checkoutButton.nextSibling);
                }
            });

            confirmCheckoutBtn.addEventListener('click', () => {
                const keranjangRows = keranjangTable.querySelectorAll('tbody tr');
                if (keranjangRows.length === 0) {
                    const errorNoItems = document.createElement('div');
                    errorNoItems.classList.add('alert', 'alert-danger', 'mt-3');
                    errorNoItems.textContent = 'Tidak ada barang yang di-checkout.';
                    const modalBody = document.querySelector('.modal-body');
                    modalBody.insertBefore(errorNoItems, checkoutForm);
                } else if (checkoutForm.checkValidity()) {
                    checkoutForm.submit();
                } else {
                    alert('Nama Pembeli dan Tanggal Pembelian harus diisi.');
                }
            });

            // Set default purchase date to today
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const formattedToday = `${yyyy}-${mm}-${dd}`;
            document.getElementById('purchaseDate').value = formattedToday;
        });
    </script>
@endsection
