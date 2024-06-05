<?php

namespace App\Repositories;

use App\Models\Service_Sub_Category;
use App\Repositories\BaseRepository;

class Service_Sub_CategoryRepository extends BaseRepository
{
    
    protected $fieldSearchable = [
        'service_sub_cat_name',
        'service_sub_cat_description',
        'service_sub_cat_status',
        'service_cat_id',
        'service_sub_cat_created_by',
        'service_sub_cat_updated_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Service_Sub_Category::class;
    }
}
