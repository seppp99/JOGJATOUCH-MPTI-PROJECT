<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNetworkOrderRequest extends FormRequest
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
            'paket_dipilih'    => 'required|string',
            'nama_pelanggan'   => 'required|string|max:255',
            'whatsapp_number'  => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'jumlah_karyawan'  => 'nullable|integer',
            'jumlah_lokasi'    => 'nullable|integer',
            'perangkat_utama'  => 'nullable|string|max:255',
            'detail_kebutuhan' => 'required|string',
            'alamat'           => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'paket_dipilih.required' => 'Silakan pilih paket yang diinginkan terlebih dahulu.',
            'nama_pelanggan.required' => 'Nama lengkap wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jumlah_karyawan.integer' => 'Jumlah karyawan harus berupa angka.',
            'jumlah_lokasi.integer' => 'Jumlah lokasi harus berupa angka.',
            'detail_kebutuhan.required' => 'Mohon jelaskan masalah utama yang dihadapi.',
            'alamat.required' => 'Alamat lokasi wajib diisi.',
        ];
    }
}
