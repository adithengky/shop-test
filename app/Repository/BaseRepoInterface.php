<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface BaseRepoInterface
{
    public function create(array $attributes): Model;

    public function find($column, $value);

    public function update($column, $value, array $data);
    
    public function delete($column, $value);
}
