<?php
namespace App\Repository\Order;

use App\Repository\BaseRepoInterface;
use Illuminate\Database\Eloquent\Model;

interface OrderRepoInterface extends BaseRepoInterface
{
    public function getDatatableRelation();
}