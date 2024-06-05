<?php

namespace App\Repositories;

use App\Models\ServiceSubSubCategory;
use App\Repositories\BaseRepository;

class ServiceSubSubCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'service_subsub_cat_name',
        'service_subsub_cat_description',
        'service_subsub_cat_status',
        'service_sub_cat_id',
        'service_subsub_cat_created_by',
        'service_subsub_cat_updated_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ServiceSubSubCategory::class;
    }
}
