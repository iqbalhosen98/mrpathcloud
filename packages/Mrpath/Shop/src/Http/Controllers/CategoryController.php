<?php

namespace Mrpath\Shop\Http\Controllers;

use Mrpath\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * CategoryRepository object
     *
     * @var \Mrpath\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }
}
