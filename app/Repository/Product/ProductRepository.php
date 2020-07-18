<?php
namespace App\Repository\Product;

use App\Models\Product;
use App\Repository\Product\ProductRepoInterface;
use App\Repository\BaseRepository;
use DataTables;

class ProductRepository extends BaseRepository implements ProductRepoInterface
{
    public function __construct(Product $model) 
    {
        parent::__construct($model);
    }
}