<?php
namespace App\Repository\User;

use App\Models\User;
use App\Repository\User\UserRepoInterface;
use App\Repository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepoInterface
{
    public function __construct(User $model) 
    {
        parent::__construct($model);
    }

    public function findByArray($data)
    {
        $q = $this->model;
        foreach($data as $key => $v)
        {
            $q = $q->where($key, $v);
        }
        return $q->first();
    }
}
