<?php
namespace App\Repository\Order;

use App\Models\Order;
use App\Repository\Order\OrderRepoInterface;
use App\Repository\BaseRepository;
use DataTables;

class OrderRepository extends BaseRepository implements OrderRepoInterface
{
    public function __construct(Order $model) 
    {
        parent::__construct($model);
    }

    public function getDatatableRelation()
    {
        $query = $this->model->with(['product', 'user'])->get();
        return DataTables::of($query)->make(true);
    }

    public function findWithRelation($column, $value) {
        return $this->model->with(['product', 'user'])->where($column, $value)->first();
    }
}