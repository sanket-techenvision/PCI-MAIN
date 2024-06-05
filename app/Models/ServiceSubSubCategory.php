<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service_Sub_Category;
class ServiceSubSubCategory extends Model
{
    public $table = 'service_sub_sub_categories';
    protected $primaryKey = 'service_subsub_cat_id';
    public $fillable = [
        'service_subsub_cat_name',
        'service_subsub_cat_description',
        'service_subsub_cat_status',
        'service_sub_cat_id',
        'service_subsub_cat_created_by',
        'service_subsub_cat_updated_by'
    ];

    protected $casts = [
        'service_subsub_cat_name' => 'string',
        'service_subsub_cat_description' => 'string',
        'service_subsub_cat_status' => 'string',
        'service_subsub_cat_created_by' => 'string',
        'service_subsub_cat_updated_by' => 'string'
    ];

    public static array $rules = [
        'service_subsub_cat_name' => 'required|string|max:255',
        'service_subsub_cat_description' => 'nullable|string|max:255',
        'service_subsub_cat_status' => 'nullable|string|max:255',
        'service_sub_cat_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'service_subsub_cat_created_by' => 'nullable|string|max:255',
        'service_subsub_cat_updated_by' => 'nullable|string|max:255'
    ];

    public function serviceSubCat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\ServiceSubCategory::class, 'service_sub_cat_id');
    }
    public function serviceSubCategory()
    {
        return $this->belongsTo(Service_Sub_Category::class, 'service_sub_cat_id');
    }
}
