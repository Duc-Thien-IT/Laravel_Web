<?php

namespace App\Repositories\Repository;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function search($column, $keyword, $perPage = 3)
    {
        return Product::where($column, 'LIKE', '%' . $keyword . '%')->paginate($perPage);
    }

    public function paginate($perPage = 3)
    {
        return Product::paginate($perPage);
    }
}
