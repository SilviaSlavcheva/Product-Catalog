<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\ProductRepoInterface;

class ProductRepo implements ProductRepoInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function get(int $id)
    {
        return Product::all()->where('user_id', $id);
    }

    public function store($data)
    {
        return Product::create($data);
    }
    public function update($data, $product)
    {
        if ($product->isEditable()) {
            $product->update($data);
        }

        return $product;
    }

    public function delete($product)
    {
        if ($product->isEditable()) {
            $product->delete();
        }
    }
}
