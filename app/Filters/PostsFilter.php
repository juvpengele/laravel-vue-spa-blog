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

    protected function search($value)
    {
        return $this->builder->search($value);
    }

    protected function popular()
    {
        return $this->builder->orderBy("visits", "DESC");
    }


}