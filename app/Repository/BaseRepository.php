<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use App\Repository\BaseRepoInterface;
use DataTables;

Class BaseRepository implements BaseRepoInterface {
    protected $model;

    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function find($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function update($column, $value, array $data)
    {
        return $this->model->where($column, $value)->update($data);
    }

    public function delete($column, $value)
    {
        return $this->model->where($column, $value)->delete();
    }

    public function getDatatable()
    {
        return DataTables::of($this->model->get())->make(true);
    }

}


?>