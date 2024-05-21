@extends('grooming.layout')

@section('title', 'Tambah Produk Grooming')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Tambah Produk Grooming</h2>
            <form action="{{ route('grooming.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="foto_produk">Foto Produk:</label>
                    <input type="file" name="foto_produk" id="foto_produk" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                </div>
                <div class="form-group" id="kategori-container">
                    <label for="kategori">Kategori</label>
                    <button type="button" class="btn btn-danger btn-sm" id="tambah-kategori">Tambah</button>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('tambah-kategori').addEventListener('click', function() {
            var kategoriContainer = document.getElementById('kategori-container');
            var divInputKategori = document.createElement('div');
            divInputKategori.classList.add('inputkategori');
            divInputKategori.style.marginBottom = '10px';
            divInputKategori.innerHTML = `
                <input type="text" name="category-name[]" class="category-name form-control" placeholder="Nama kategori">
                <input type="number" name="category-price[]" class="category-price form-control" placeholder="Harga">
                <input type="number" name="category-discount[]" class="category-discount form-control" placeholder="Diskon(%)" oninput="calculatePrice(this)">
                <input type="number" name="category-final-price[]" class="category-final-price form-control" placeholder="Harga Final" readonly>
            `;
            kategoriContainer.appendChild(divInputKategori);
        });

        function calculatePrice(input) {
            var priceInput = input.previousElementSibling.value;
            var discount = input.value;
            var finalPrice = priceInput - (priceInput * (discount / 100));
            input.nextElementSibling.value = finalPrice.toFixed(2);
        }
    </script>
@endsection