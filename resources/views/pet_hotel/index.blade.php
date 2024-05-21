@extends('pethotel.layout')

@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Daftar Produk') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('pethotel.create') }}" class="btn btn-primary">Tambah Produk</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Foto Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pethotels as $pethotel)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><img src="{{ asset('images/' . $pethotel->foto_produk) }}" alt="Foto Produk" style="max-width: 100px;"></td>
                                    <td>{{ $pethotel->kategori }}</td>
                                    <td>{{ $pethotel->harga }}</td>
                                    <td>{{ $pethotel->diskon }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('pethotel.edit', $pethotel->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('pethotel.destroy', $pethotel->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
