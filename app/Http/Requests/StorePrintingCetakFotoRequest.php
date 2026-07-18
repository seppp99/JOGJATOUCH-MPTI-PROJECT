<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrintingCetakFotoRequest extends FormRequest
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
            'paket_dipilih'     => 'required|string',
            'nama_pelanggan'    => 'required|string|max:255',
            'whatsapp_number'   => 'required|string|max:20',
            'ukuran_cetak'      => 'required|string',
            'finishing_kertas'  => 'required|string',
            'laminasi'          => 'required|string',
            'jumlah'            => 'required|integer|min:1',
            'detail_kebutuhan'  => 'required|string',
        ];
    }
}
