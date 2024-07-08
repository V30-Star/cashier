@extends('layout/template')

@section('content')
    <div class="container mt-5">
        <h2>Detail Checkout</h2>
        <div class="card">
            <div class="card-header">
                <h4>Nama Pembeli: {{ $checkout->buyer_name }}</h4>
                <h4>Tanggal Pembelian: {{ $checkout->purchase_date }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="keranjangTable">
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
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item['kode_barang'] }}</td>
                                <td>{{ $item['nama_barang'] }}</td>
                                <td>{{ $item['harga_barang'] }}</td>
                                <td>{{ $item['jumlah_barang'] }}</td>
                                <td>{{ $item['total_harga'] }}</td>
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#keranjangTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
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

                            // Add header
                            var now = new Date();
                            var header = function(data) {
                                doc.setFontSize(18);
                                doc.setTextColor(40);
                                doc.text('Detail Checkout', 200, 30);
                                doc.text('Nama Pembeli: {{ $checkout->buyer_name }}', 200, 50);
                                doc.text('Tanggal Pembelian: {{ $checkout->purchase_date }}',
                                    200, 70);
                            };
                            doc['header'] = header;
                            doc['footer'] = function(page, pages) {
                                return {
                                    text: 'Page ' + page + ' of ' + pages,
                                    alignment: 'center'
                                };
                            };
                        }
                    },
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).append(
                                '<div style="position:fixed; top:50%; left:50%; opacity:0.1; font-size:100px; transform:translate(-50%, -50%) rotate(-45deg); z-index:9999; pointer-events:none;">Kembar Jaya Motor</div>'
                            );

                            // Add header
                            var header = '<h1>Detail Checkout</h1>';
                            header += '<h3>Nama Pembeli: {{ $checkout->buyer_name }}</h3>';
                            header += '<h3>Tanggal Pembelian: {{ $checkout->purchase_date }}</h3>';
                            $(win.document.body).find('h1').html(header);
                        }
                    }
                ]
            });
        });
    </script>
@endsection
