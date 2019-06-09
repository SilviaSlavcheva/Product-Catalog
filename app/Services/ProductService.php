<?php

namespace App\Services;

use App\Repositories\ProductRepoInterface;
use App\Services\ProductServiceInterface;
use App\Utils\Service\CrudTrait;

class ProductService implements ProductServiceInterface
{
    use CrudTrait;

    /**
     * @var \Repositories\ProductRepo
     */
    private $repo;

    public function __construct(ProductRepoInterface $repo)
    {
        $this->repo = $repo;
    }

    public function get(int $id)
    {
        $data = $this->repo->get($id);
        return $data;
    }
}
