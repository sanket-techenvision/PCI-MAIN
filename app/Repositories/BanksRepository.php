<?php

namespace App\Repositories;

use App\Models\Banks;
use App\Repositories\BaseRepository;

class BanksRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'bank_name',
        'bank_applicant',
        'bank_swift_code',
        'bank_address',
        'bank_country',
        'bank_status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Banks::class;
    }
}
