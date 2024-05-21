@extends('pethotel.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Produk Baru') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pethotel.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="foto_produk" class="col-md-4 col-form-label text-md-right">Foto Produk</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" id="foto_produk" name="foto_produk">
                            </div>
                        </div>

                        <div class="kategori-container">
                            <div class="kategori-item">
                                <div class="form-group row">
                                    <label for="kategori" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="kategori_nama[]" placeholder="Nama Kategori">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harga" class="col-md-4 col-form-label text-md-right">Harga Produk</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control harga" name="kategori_harga[]" placeholder="Harga">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-md-4 col-form-label text-md-right">Diskon Produk</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control diskon" name="kategori_diskon[]" placeholder="Diskon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-md-4 col-form-label text-md-right">Total Harga</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control total" name="kategori_total[]" placeholder="Total Harga" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-success" id="tambah-kategori">Tambah Kategori</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('tambah-kategori').addEventListener('click', function() {
        var kategoriContainer = document.querySelector('.kategori-container');
        var divInputKategori = document.createElement('div');
        divInputKategori.classList.add('kategori-item');
        divInputKategori.innerHTML = `
            <div class="form-group row">
                <label for="kategori" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="kategori_nama[]" placeholder="Nama Kategori">
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-md-4 col-form-label text-md-right">Harga Produk</label>
                <div class="col-md-6">
                    <input type="number" class="form-control harga" name="kategori_harga[]" placeholder="Harga">
                </div>
            </div>
            <div class="form-group row">
                <label for="diskon" class="col-md-4 col-form-label text-md-right">Diskon Produk</label>
                <div class="col-md-6">
                    <input type="number" class="form-control diskon" name="kategori_diskon[]" placeholder="Diskon">
                </div>
            </div>
            <div class="form-group row">
                <label for="total" class="col-md-4 col-form-label text-md-right">Total Harga</label>
                <div class="col-md-6">
                    <input type="number" class="form-control total" name="kategori_total[]" placeholder="Total Harga" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="button" class="btn btn-danger hapus-kategori">Hapus</button>
                </div>
            </div>
        `;
        kategoriContainer.appendChild(divInputKategori);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('hapus-kategori')) {
            e.target.closest('.kategori-item').remove();
        }
    });

    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('diskon')) {
            var hargaInput = e.target.closest('.kategori-item').querySelector('.harga');
            var totalInput = e.target.closest('.kategori-item').querySelector('.total');
            var diskon = parseFloat(e.target.value);
            var harga = parseFloat(hargaInput.value);
            if (!isNaN(diskon) && !isNaN(harga)) {
                var hargaDiskon = harga - (harga * (diskon / 100));
                totalInput.value = hargaDiskon.toFixed(2);
            }
        }
    });
</script>
@endsection
