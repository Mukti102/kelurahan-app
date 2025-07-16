@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Pengantar Nikah')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-pengantar-nikah.konfirmasi', Crypt::encrypt($surat->id))" />
        <div class="container card p-5">
            {{-- isi surat --}}
            <x-templates.surat-nikah :surat="$surat">
                SURAT PENGANTAR NIKAH
            </x-templates.surat-nikah>
        </div>
    </div>
@endsection
