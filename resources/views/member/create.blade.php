@extends('adminlte::page')

@section('title', 'Tambah Member')

@section('content_header')
    <h1>Tambah Member</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama_service">Nama Member</label>
                    <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" id="nama_member" required value="{{ old('nama_member') }}">
                    @error('nama_member')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nis">No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" required value="{{ old('no_telepon') }}">
                    @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('member.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop