@extends('adminlte::page')

@section('title', 'Tambah Customer')

@section('content_header')
    <h1>Tambah Customer</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama_customer">Nama Customer</label>
                    <input type="text" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" id="nama_customer" required value="{{ old('nama_customer') }}">
                    @error('nama_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nis">No Hp</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" required value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" required placeholder="Contoh: gang,IndraBakti" value="{{ old('alamat') }}">
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop