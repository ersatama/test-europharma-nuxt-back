<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\BrandContract;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            BrandContract::TITLE    =>  'required|min:2|max:255',/*
            BrandContract::ICON     =>  'required|mimes:jpeg,jpg,png,gif|max:2048',
            BrandContract::IMG      =>  'required|mimes:jpeg,jpg,png,gif|max:10240'*/
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            BrandContract::TITLE,
            BrandContract::ICON
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            BrandContract::TITLE.'.required'    =>  'Укажите название бренда',
            BrandContract::TITLE.'.min'         =>  'Минимальное количество символов 2',
            BrandContract::TITLE.'.max'         =>  'Максимальное количество символов 255',
            BrandContract::ICON.'.required'     =>  'Загрузите иконку для Бренда',
            BrandContract::ICON.'.mimes'        =>  'Допустимый формат иконки jpeg,jpg,png,gif',
            BrandContract::ICON.'.max'          =>  'Максимальный размер иконки 2 мегабайт',
            BrandContract::IMG.'.required'      =>  'Загрузите картинку для Бренда',
            BrandContract::IMG.'.mimes'         =>  'Допустимый формат картинки jpeg,jpg,png,gif',
            BrandContract::IMG.'.max'           =>  'Максимальный размер картинки 10 мегабайт'
        ];
    }
}
