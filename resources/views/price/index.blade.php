@extends('layout.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Harga Emas Hari Ini</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Harga Emas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($prices as $price)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $price->buy }}</td>
                                            <td>{{ $price->sell }}</td>
                                            <td><a href="#" class="btn btn-secondary">Delete</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                Belum Ada Isinya
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
