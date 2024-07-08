<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cashier Company</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/"
                    class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
                    <li><a href="{{ route('lihatBarang') }}" class="nav-link px-2 link-body-emphasis">Lihat Data
                            Barang</a></li>
                    <li><a href="{{ route('buatBarang') }}" class="nav-link px-2 link-body-emphasis">Buat Data
                            Barang</a></li>
                    <li><a href="{{ route('keranjang') }}" class="nav-link px-2 link-body-emphasis">Keranjang
                            Belanja</a></li>
                    <li><a href="{{ route('history') }}" class="nav-link px-2 link-body-emphasis">Histroy
                            Belanja</a></li>
                </ul>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sign Out
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Sign Out</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
    <!-- Memuat jQuery terlebih dahulu -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Memuat Popper.js untuk Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <!-- Memuat Bootstrap CSS dan JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <!-- Memuat DataTables dan ekstensi -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

      <!-- Your Custom JavaScript -->
    <script>
        $(document).ready(function() {
            $('#tableList').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            // Add watermark
                            var watermarkText = 'Confidential';
                            doc.content.forEach(function(item) {
                                if (item.text && item.text.indexOf('Confidential') !== -1) {
                                    item.text = item.text.replace('Confidential', watermarkText);
                                }
                            });

                            // Alternatively, you can use background watermark
                            doc.background = function() {
                                doc.setFontSize(50);
                                doc.setTextColor('blue');
                                doc.setOpacity(0.1);
                                doc.text(watermarkText, 200, 400, {
                                    angle: -45
                                });
                            };
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
    </script>
</body>

</html>
