@extends('layout/template')

@section('content')
    <div class="container mt-5">
        <h2>Riwayat Checkout</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped table-bordered" id="historyTable">
            <thead>
                <tr>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Pembelian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkouts as $checkout)
                    <tr>
                        <td>{{ $checkout->buyer_name }}</td>
                        <td>{{ $checkout->purchase_date }}</td>
                        <td>
                            <a href="{{ route('history.show', $checkout->id) }}" class="btn btn-info">Detail</a>
                            <form action="{{ route('history.delete', $checkout->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
