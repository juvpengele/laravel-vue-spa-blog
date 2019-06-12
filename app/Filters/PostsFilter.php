<?php

namespace App\Filters;


class PostsFilter
{
    protected $filters = ["search", "popular"];
    protected $builder;
    protected $request;


    public function __construct()
    {
        $this->filters = collect($this->filters);
    }

    /**
     * @param $request
     * @param $builder
     * @return mixed
     */
    public function apply ($request, $builder)
    {
        $this->builder = $builder;
        $this->request = collect($request);

        foreach ($this->request as $filterKey => $value) {
            if($this->filters->contains($filterKey) && method_exists($this, $filterKey)) {
                $this->builder = $this->$filterKey($value);
            }
        }

        return $this->builder;
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function search($value)
    {
        return $this->builder->search($value)->take(5);
    }

    /**
     * @return mixed
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = null;

        return $this->builder->orderBy("visits", "DESC");
    }


}