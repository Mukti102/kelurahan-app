@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat Keterangan Penghasilan')

@section('content')
    <div class="container mt-3 p-4">
        <x-konfirmasi :action="route('surat-keterangan-penghasilan.konfirmasi', Crypt::encrypt($surat->id))" />
        <div class="container card p-5">
            {{-- isi surat --}}
            <x-templates.surat-penghasilan :surat="$surat">
                SURAT KETERANGAN PENGHASILAN ORANG TUA
            </x-templates.surat-penghasilan>
        </div>
    </div>
@endsection
