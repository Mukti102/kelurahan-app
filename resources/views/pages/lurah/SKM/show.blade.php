@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Keterangan Miskin')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-keterangan-miskin.konfirmasi', Crypt::encrypt($surat->id))" />
        <div class="container card p-5">
            <x-templates.surat-miskin :surat="$surat">
                SURAT KETERANGAN KURANG MAMPU
            </x-templates.surat-miskin>
        </div>
    </div>
@endsection
