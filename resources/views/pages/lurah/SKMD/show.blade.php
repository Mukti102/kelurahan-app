@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Keterangan Meninggal Dunia')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-keterangan-meninggal-dunia.konfirmasi', Crypt::encrypt($surat->id))" />
        <div class="container card p-5">
            <x-templates.surat-kematian :surat="$surat">
                SURAT KETERANGAN MENINGGAL DUNIA
            </x-templates.surat-kematian>
        </div>
    </div>
@endsection
