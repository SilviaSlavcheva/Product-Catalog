<?php

namespace App\Repositories;

interface ProductRepoInterface
{
    public function getAll();
    public function get(int $id);
    public function store($data);
    public function update($data, $product);
    public function delete($data);
}
