<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductValidator
{

    public static function create(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|max:150|unique:products,name',
            'sku' => 'required|min:3|max:20|unique:products,sku',
            'description' => 'required|min:5|max:255',
        ]);
    }

    public static function update(array $data, $id)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|max:150|unique:products,name,'. $id,
            'sku' => 'required|min:3|max:20|unique:products,sku,'. $id,
            'description' => 'required|min:5|max:255',
        ]);
    }
}
