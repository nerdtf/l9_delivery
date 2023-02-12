<?php

namespace App\Services;

use App\Models\Courier;

class CourierService
{

    public function getAll()
    {
        return Courier::all();
    }

    public function getById($id)
    {
        return Courier::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $courier = $this->getById($id);
        $courier->update($data);
        return $courier;
    }
}
