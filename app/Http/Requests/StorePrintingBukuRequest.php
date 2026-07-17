<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrintingBukuRequest extends FormRequest
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
            'ukuran'           => 'required|string',
            'jenis_cover'      => 'required|string',
            'penjilidan'       => 'required|string',
            'jumlah_halaman'   => 'required|string',
            'jumlah'           => 'required|integer|min:1',
            'detail_kebutuhan' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string'   => ':attribute harus berupa teks.',
            'max'      => ':attribute maksimal :max karakter.',
            'integer'  => ':attribute harus berupa angka bulat.',
            'min'      => ':attribute minimal :min.',
        ];
    }
}
