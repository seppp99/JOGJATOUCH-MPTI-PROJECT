<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrintingPhotobookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paket_dipilih'     => 'required|string',
            'nama_pelanggan'    => 'required|string|max:255',
            'whatsapp_number'   => 'required|string|max:20',
            'ukuran'            => 'required|string',
            'cover'             => 'required|string',
            'kertas_isi'        => 'required|string',
            'jumlah_halaman'    => 'required|string',
            'link_folder_foto'  => 'required|url',
            'jumlah'            => 'required|integer|min:1',
            'detail_kebutuhan'  => 'required|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'link_folder_foto.url' => 'Link folder harus berupa URL yang valid (contoh: https://drive.google.com/...).',
        ];
    }
}
