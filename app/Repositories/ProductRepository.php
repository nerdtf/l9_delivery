<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends AbstractRepository
{
    private const DEFAULT_PAGE_SIZE = 20;

    /** @var string */
    protected string $modelClass = Product::class;

    public function index(array $queryParams): mixed
    {
        $query = $this->_getInstance();
        if (!empty($queryParams['search'])) {
            $query = $query->where('name', 'like', "%{$queryParams['search']}%")
                        ->orWhere('description', 'like', "%{$queryParams['search']}%");
        }

        return $query->orderBy('created_at', 'desc')->paginate(
            (int) ($queryParams['per_page'] ?? self::DEFAULT_PAGE_SIZE)
        );
    }

    public function show($id)
    {
        return $this->_getInstance()->findOrFail($id);
    }
}
