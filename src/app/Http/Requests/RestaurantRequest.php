<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_id' => 'required|integer',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'acceptable_days' => 'required|integer|min:1',
            'detail' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '店名は必須です。',
            'name.max' => '店名は255文字以内で入力してください。',
            'image.required' => '画像は必須です。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像はJPEG、PNG、JPG、GIF形式のみ対応しています。',
            'image.max' => '画像サイズは2MB以内にしてください。',
            'area_id.required' => 'エリアは必須です。',
            'area_id.integer' => 'エリアを正しく選択してください。',
            'genre_id.required' => 'ジャンルは必須です。',
            'genre_id.integer' => 'ジャンルを正しく選択してください。',
            'acceptable_days.required' => '予約猶予日数は必須です。',
            'acceptable_days.integer' => '予約猶予日数は整数で入力してください。',
            'acceptable_days.min' => '予約猶予日数は1以上で入力してください。',
            'detail.required' => '詳細は必須です。',
        ];
    }
}
