<?php

namespace App\Repositories;

use App\Models\Drafts;
use App\Repositories\BaseRepository;

class DraftsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'service_cat_id',
        'service_sub_cat_id',
        'service_subsub_cat_id',
        'bank_id',
        'payment_status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Drafts::class;
    }
}
