<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_Category extends Model
{
    public $table = 'service_categories';

    public $fillable = [
        'service_cat_name',
        'service_cat_description',
        'service_cat_status',
        'cat_created_by',
        'cat_updated_by'
    ];

    protected $casts = [
        'service_cat_name' => 'string',
        'service_cat_description' => 'string',
        'service_cat_status' => 'string',
        'cat_created_by' => 'string',
        'cat_updated_by' => 'string'
    ];

    public static array $rules = [
        'service_cat_name' => 'required|string|max:255',
        'service_cat_description' => 'nullable|string|max:255',
        'service_cat_status' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'cat_created_by' => 'nullable|string|max:255',
        'cat_updated_by' => 'nullable|string|max:255'
    ];

    
}
