<!-- resources/views/admin/status_pengiriman.blade.php -->

@extends('layouts.app') <!-- Kalau kamu pakai layout -->

@section('content')
    <h1>Status Pengiriman</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Pengirim</th>
                <th>Alamat Jemput</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_status as $status)
                <tr>
                    <td>{{ $status->nama_pengirim }}</td>
                    <td>{{ $status->alamat_jemput }}</td>
                    <td>{{ $status->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
