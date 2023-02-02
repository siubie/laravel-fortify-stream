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
                            @include('layout.flash')
                            <div class="text-right">
                                <a href="{{ route('price.create') }}" class="btn btn-primary mb-3">Create New Price</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <caption>Tabel Harga Jual dan Beli</caption>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-right">Harga Beli</th>
                                        <th class="text-right">Harga Jual</th>
                                        <th class="text-right">Tanggal</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    {{-- @if (count($prices) > 0)
                                        @foreach ($prices as $key => $price)
                                            <tr>
                                                <td>{{ $key + $prices->firstItem() }}</td>
                                                <td class="text-right">@money($price->buy, 'IDR')</td>
                                                <td class="text-right">@money($price->sell, 'IDR')</td>
                                                <td class="text-right">{{ $price->date }}</td>
                                                <td class="text-right">
                                                    <form action="{{ route('price.destroy', $price->id) }}" method="post">
                                                        @csrf()
                                                        @method('DELETE')
                                                        <a href="{{ route('price.edit', $price->id) }}"
                                                            class="btn btn-success">Edit</a>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda yakin akan menghapus ?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif --}}
                                    @forelse ($prices as $key=>$price)
                                        <tr>
                                            <td>{{ $key + $prices->firstItem() }}</td>
                                            <td class="text-right">@money($price->buy, 'IDR')</td>
                                            <td class="text-right">@money($price->sell, 'IDR')</td>
                                            <td class="text-right">{{ $price->date }}</td>
                                            <td class="text-right">
                                                <form action="{{ route('price.destroy', $price->id) }}" method="post">
                                                    @csrf()
                                                    @method('DELETE')
                                                    <a href="{{ route('price.edit', $price->id) }}"
                                                        class="btn btn-success">Edit</a>
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus ?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                Belum Ada Isinya
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            {!! $prices->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
