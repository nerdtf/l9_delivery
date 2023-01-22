<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected function _getInstance(): Model
    {
        return app($this->modelClass);
    }
}
