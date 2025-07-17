@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Pengantar SKCK')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-pengantar-skck.konfirmasi', Crypt::encrypt($surat->id))" :surat="$surat" />
        <div class="container card p-5">
            <x-templates.surat-skck :surat="$surat">
                SURAT PENGANTAR KETERANGAN CATATAN KEPOLISIAN
            </x-templates.surat-skck>
        </div>
    </div>
@endsection
