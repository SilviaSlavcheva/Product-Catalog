<?php

namespace App\Utils\Service;

trait CrudTrait
{
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store($data)
    {
        return $this->repo->store($data);
    }

    public function update($data, $product)
    {
        return $this->repo->update($data, $product);
    }

    public function delete($data)
    {
        return $this->repo->delete($data);
    }
}
