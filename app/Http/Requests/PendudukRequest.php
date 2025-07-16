<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendudukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'string', 'max:255'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:255'],
            'status_penduduk' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2024'],

            // keluarga
            'nik_ayah' => ['required', 'string', 'max:255'],
            'nama_ayah' => ['required', 'string', 'max:255'],
            'nik_ibu' => ['required', 'string', 'max:255'],
            'nama_ibu' => ['required', 'string', 'max:255'],

            'hubungan_keluarga' => ['required', 'string', 'max:255'],

            // alamat
            'alamat_sekarang' => ['required', 'string', 'max:255'],
            'dusun' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],

            // pendidikan
            'pendidikan_terakhir' => ['required'],
            'pekerjaan' => ['required'],

            // kesehatan
            'golongan_darah' => ['required'],
            'cacat' => ['required'],
            'asuransi_kesehatan' => ['required'],

            // perkawinan
            'status_perkawinan' => ['required'],
            'no_akta_nikah' => ['nullable'],
            'no_akta_cerai' => ['nullable'],
            'tanggal_nikah' => ['nullable'],
            'tanggal_cerai' => ['nullable']

        ];
    }
}
