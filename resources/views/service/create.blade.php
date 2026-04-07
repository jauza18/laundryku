@extends('adminlte::page')

@section('title', 'Tambah Service')

@section('content_header')
    <h1>Tambah Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama_service">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" id="nama_layanan" required value="{{ old('nama_layanan') }}">
                    @error('nama_layanan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nis">Harga</label>
                    <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" required value="{{ old('harga') }}">
                    @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Satuan</label>
                    <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" id="satuan" required placeholder="Contoh: gang,IndraBakti" value="{{ old('satuan') }}">
                    @error('satuan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop