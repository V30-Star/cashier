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
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="button" class="btn btn-success mt-3" id="checkoutButton">
                Checkout
            </button>
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
                    <p>Apakah Anda yakin ingin melakukan checkout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmCheckoutBtn">Ya, Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <form id="checkoutForm" action="{{ route('checkout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const confirmCheckoutBtn = document.getElementById('confirmCheckoutBtn');
        const checkoutForm = document.getElementById('checkoutForm');
        const checkoutButton = document.getElementById('checkoutButton');
        const keranjangTable = document.getElementById('keranjangTable');

        checkoutButton.addEventListener('click', () => {
            const hasItems = keranjangTable.querySelector('tbody').childElementCount > 0;
            if (hasItems) {
                const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                checkoutModal.show();
            } else {
                alert('Keranjang kosong. Tidak ada barang untuk di-checkout.');
            }
        });

        confirmCheckoutBtn.addEventListener('click', () => {
            checkoutForm.submit();
        });

        $(document).ready(function() {
            $('#keranjangTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            // Add watermark
                            var watermarkText = 'Confidential';
                            doc.watermark = {
                                text: watermarkText,
                                color: 'blue',
                                opacity: 0.1,
                                bold: true,
                                italics: false
                            };

                            // Alternatively, you can use background
                            doc.content.push({
                                text: watermarkText,
                                fontSize: 50,
                                color: 'blue',
                                opacity: 0.1,
                                bold: true,
                                italics: false,
                                angle: -45,
                                absolutePosition: {
                                    x: 200,
                                    y: 400
                                }
                            });
                        }
                    },
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).append(
                                '<div style="position:fixed; top:50%; left:50%; opacity:0.1; font-size:100px; transform:translate(-50%, -50%) rotate(-45deg); z-index:9999; pointer-events:none;">Kembar Jaya Motor</div>'
                            );
                        }
                    }
                ]
            });
        });
    });
</script>
