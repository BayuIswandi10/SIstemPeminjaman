<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKeranjangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nim' => ['required'],
            'jumlah' => [
                'required',
                'integer',
                'min:1', // Ensure that the quantity is greater than or equal to 1
                Rule::exists('barangs', 'stok')->where(function ($query) {
                    // Additional validation to check if the requested quantity is less than or equal to the available stock
                    $query->where('barang_id', $this->barang_id)
                        ->where('stok', '>=', $this->jumlah);
                }),
            ],
            'barang_id' => ['required', 'exists:barangs,barang_id'],
        ];
    }
}
