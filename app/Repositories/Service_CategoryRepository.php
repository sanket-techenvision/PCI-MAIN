<?php

namespace App\Repositories;

use App\Models\Service_Category;
use App\Repositories\BaseRepository;

class Service_CategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'service_cat_name',
        'service_cat_description',
        'service_cat_status',
        'cat_created_by',
        'cat_updated_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Service_Category::class;
    }
}
