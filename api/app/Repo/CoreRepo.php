<?php


namespace App\Repo;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class CoreRepo
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;


    /**
     * @return Builder|Model
     */
    protected function query(): Model|Builder
    {
        return $this->model->newModelQuery();
    }

}
