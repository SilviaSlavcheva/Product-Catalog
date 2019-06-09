<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductRequest;
use App\Jobs\StoreProductJob;
use App\Product;
use App\Services\ProductService;
use App\User;
use Auth;
use Gate;

class ProductController extends ApiController
{
    private $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }
    public function index()
    {
        $user = Auth::guard('api')->user();

        if (Gate::allows('accessAdminpanel', $user)) {
            $productsAll = $this->service->getAll();
            return $this->showAll($productsAll);
        }

        $productsUser = $this->service->get(Auth::guard('api')->id());

        return $this->showAll($productsUser);
    }

    public function show(Product $product)
    {
        if (Gate::denies('canAccess', $product)) {
            return $this->errorResponse('You don\'t have the permissions to perform an action.', 403);
        }
        return $this->showOne($product);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('api')->id();
        $data['role'] = User::DEFAULT_ROLE;

        $product = $this->service->store($data);

        StoreProductJob::dispatchNow($product);

        return $this->showOne($product, 201);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if (Gate::denies('canAccess', $product)) {
            return $this->errorResponse('You don\'t have the permissions to perform an action.', 403);
        }

        if (!$product->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $data = $this->service->update($request->all(), $product);
        //event(new ProductWasUpdated());

        return $this->showOne($product);
    }

    public function delete(Product $product)
    {
        if (Gate::denies('canAccess', $product)) {
            return $this->errorResponse('You don\'t have the permissions to perform an action.', 403);
        }
        $this->service->delete($product);
        //event(new ProductWasUpdated());

        return $this->showOne($product, 204);
    }
}
