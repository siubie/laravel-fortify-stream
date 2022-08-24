@extends('layout.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Harga Emas</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('price.store') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h4>Create Harga Emas</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Masukkan Harga Beli</label>
                                    <input type="buy" name="buy" value="{{ old('buy') }}"
                                        class="form-control @error('buy') is-invalid @enderror"
                                        placeholder="Masukkan Harga Beli">
                                    @error('buy')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Harga Jual</label>
                                    <input type="sell" name="sell" value="{{ old('sell') }}"
                                        class="form-control @error('sell') is-invalid @enderror"
                                        placeholder="Masukkan Harga Jual">
                                    @error('sell')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
