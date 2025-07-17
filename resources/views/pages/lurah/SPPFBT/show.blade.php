@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Pernyataan Penguasaan Tanah')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-pernyataan-penguasaan-tanah.konfirmasi', Crypt::encrypt($surat->id))" :surat="$surat" />
        <div class="container card p-5">
            <x-templates.surat-tanah :surat="$surat">SURAT KETERANGAN TANAH</x-templates.surat-tanah>
        </div>
    </div>
@endsection
