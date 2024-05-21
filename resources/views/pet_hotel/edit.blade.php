@extends('pethotel.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Produk') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pethotel.update', $pethotel->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="foto_produk" class="col-md-4 col-form-label text-md-right">Foto Produk</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" id="foto_produk" name="foto_produk">
                                @if($pethotel->foto_produk)
                                <img src="{{ asset('images/' . $pethotel->foto_produk) }}" alt="Foto Produk" class="mt-2" style="max-width: 200px;">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori Produk</label>
                            <div class="col-md-6">
                                <select class="form-control" id="kategori" name="kategori[]" multiple>
                                    <option value="Makanan" {{ in_array('Makanan', explode(',', $pethotel->kategori)) ? 'selected' : '' }}>Makanan</option>
                                    <option value="Minuman" {{ in_array('Minuman', explode(',', $pethotel->kategori)) ? 'selected' : '' }}>Minuman</option>
                                    <option value="Mainan" {{ in_array('Mainan', explode(',', $pethotel->kategori)) ? 'selected' : '' }}>Mainan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">Harga Produk</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" id="harga" name="harga" value="{{ $pethotel->harga }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="diskon" class="col-md-4 col-form-label text-md-right">Diskon Produk</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" id="diskon" name="diskon" value="{{ $pethotel->diskon }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
