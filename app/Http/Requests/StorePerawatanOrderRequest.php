<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerawatanOrderRequest extends FormRequest
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
            'detail_kebutuhan' => 'required|string',
            'alamat'           => 'required|string'
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
            'email'    => 'Format :attribute tidak valid.'
        ];
    }
}
