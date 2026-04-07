@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content_header')
    <h1>Edit Customer</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_customer">Nama Customer</label>
                    <input type="text" name="nama_customer" class="form-control" id="nama_customer" value="{{ $customer->nama_customer }}" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No Hp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $customer->no_hp }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $customer->alamat }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop