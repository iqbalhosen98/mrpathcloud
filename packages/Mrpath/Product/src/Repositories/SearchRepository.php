<?php

namespace Mrpath\Product\Repositories;

use Mrpath\Core\Traits\Sanitizer;
use Mrpath\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Container as App;
use Mrpath\Product\Repositories\ProductRepository;

class SearchRepository extends Repository
{
    use Sanitizer;

    /**
     * ProductRepository object
     *
     * @return Object
     */
    protected $productRepository;

    /**
     * Create a new repository instance.
     *
     * @param \Mrpath\Product\Repositories\ProductRepository $productRepository
     * @param \Illuminate\Container\Container                $app
     *
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        App $app
    ) {
        parent::__construct($app);

        $this->productRepository = $productRepository;
    }

    function model()
    {
        return 'Mrpath\Product\Contracts\Product';
    }

    public function search($data)
    {
        return $this->productRepository->searchProductByAttribute($data['term'] ?? '');
    }

    /**
     * @param  array  $data
     * @return void
     */
    public function uploadSearchImage($data)
    {
        $path = request()->file('image')->store('product-search');

        $this->sanitizeSVG($path, $data['image']->getMimeType());

        return Storage::url($path);
    }
}