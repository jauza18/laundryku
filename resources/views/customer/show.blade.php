@extends('adminlte::page')

@section('title', 'Detail Customer')

@section('content_header')
    <h1>Detail Customer</h1>
@stop

@section('content')


                {{-- KOLOM KANAN: DATA --}}
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Customer</th>
                            <td>{{ $customer->nama_customer }}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>{{ $customer->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $customer->alamat }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop