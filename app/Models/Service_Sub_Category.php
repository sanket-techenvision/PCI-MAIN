<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service_Category;
use App\Models\ServiceSubSubCategory;
class Service_Sub_Category extends Model
{
    public $table = 'service_sub_categories';
    protected $primaryKey = 'service_sub_cat_id'; 
    public $fillable = [
        'service_sub_cat_name',
        'service_sub_cat_description',
        'service_sub_cat_status',
        'service_cat_id',
        'service_sub_cat_created_by',
        'service_sub_cat_updated_by'
    ];

    protected $casts = [
        'service_sub_cat_name' => 'string',
        'service_sub_cat_description' => 'string',
        'service_sub_cat_status' => 'string',
        'service_sub_cat_created_by' => 'string',
        'service_sub_cat_updated_by' => 'string'
    ];

    public static array $rules = [
        'service_sub_cat_name' => 'required|string|max:255',
        'service_sub_cat_description' => 'nullable|string|max:255',
        'service_sub_cat_status' => 'string|max:255',
        'service_cat_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'service_sub_cat_created_by' => 'string|max:255',
        'service_sub_cat_updated_by' => 'string|max:255'
    ];

    // public function serviceCat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    // {
    //     return $this->belongsTo(Service_Category::class, 'service_cat_id');
    // }
    public function serviceCategory()
    {
        return $this->belongsTo(Service_Category::class, 'service_cat_id', 'service_cat_id');
    }
    public function serviceSubSubCategories()
    {
        return $this->hasMany(ServiceSubSubCategory::class, 'service_sub_cat_id');
    }
}
