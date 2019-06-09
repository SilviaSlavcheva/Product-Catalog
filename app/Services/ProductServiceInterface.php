<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getAll();
    public function get(int $id);
    public function store($data);
    public function update($data, $product);
    public function delete($data);
}
