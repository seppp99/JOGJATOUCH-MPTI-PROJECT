<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWifiOrderRequest extends FormRequest
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
            'luas_bangunan'    => 'nullable|numeric',
            'jumlah_lantai'    => 'nullable|integer',
            'detail_kebutuhan' => 'required|string',
            'alamat'           => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'paket_dipilih.required' => 'Paket layanan wajib dipilih.',
            'nama_pelanggan.required' => 'Nama lengkap wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'detail_kebutuhan.required' => 'Detail kebutuhan wajib diisi agar kami memahami masalah Anda.',
            'alamat.required' => 'Alamat wajib diisi untuk jadwal pemasangan.',
            'luas_bangunan.numeric' => 'Luas bangunan harus berupa angka.',
            'jumlah_lantai.integer' => 'Jumlah lantai harus berupa angka.',
        ];
    }
}
