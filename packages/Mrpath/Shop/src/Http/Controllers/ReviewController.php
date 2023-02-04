<?php

namespace Mrpath\Shop\Http\Controllers;

use Mrpath\Product\Repositories\ProductRepository;
use Mrpath\Product\Repositories\ProductReviewRepository;
use Mrpath\Product\Repositories\ProductReviewImageRepository;

class ReviewController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var \Mrpath\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductReviewRepository object
     *
     * @var \Mrpath\Product\Repositories\ProductReviewRepository
     */
    protected $productReviewRepository;

    /**
     * ProductReviewImageRepository object
     *
     * @var \Mrpath\Product\Repositories\ProductReviewImageRepository
     */
    protected $productReviewImageRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\Product\Repositories\ProductRepository  $productRepository
     * @param  \Mrpath\Product\Repositories\ProductReviewRepository  $productReviewRepository
     * @param  \Mrpath\Product\Repositories\ProductReviewImageRepository  $productReviewImageRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductReviewRepository $productReviewRepository,
        ProductReviewImageRepository $productReviewImageRepository
    ) {
        $this->productRepository = $productRepository;

        $this->productReviewRepository = $productReviewRepository;

        $this->productReviewImageRepository = $productReviewImageRepository;

        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Exception
     */
    public function create($slug)
    {
        if (auth()->guard('customer')->check() || core()->getConfigData('catalog.products.review.guest_review')) {
            $product = $this->productRepository->findBySlugOrFail($slug);

            return view($this->_config['view'], compact('product'));
        }

        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $this->validate(request(), [
            'comment' => 'required',
            'rating'  => 'required|numeric|min:1|max:5',
            'title'   => 'required',
        ]);

        $data = request()->all();

        if (auth()->guard('customer')->user()) {
            $data['customer_id'] = auth()->guard('customer')->user()->id;
            $data['name'] = auth()->guard('customer')->user()->first_name . ' ' . auth()->guard('customer')->user()->last_name;
        }

        $data['status'] = 'pending';
        $data['product_id'] = $id;

        $review = $this->productReviewRepository->create($data);

        $this->productReviewImageRepository->uploadImages($data, $review);

        session()->flash('success', trans('shop::app.response.submit-success', ['name' => 'Product Review']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display reviews of particular product.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
    */
    public function show($slug)
    {
        $product = $this->productRepository->findBySlugOrFail($slug);

        return view($this->_config['view'], compact('product'));
    }

    /**
     * Customer delete a reviews from their account
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = $this->productReviewRepository->findOneWhere([
            'id'          => $id,
            'customer_id' => auth()->guard('customer')->user()->id,
        ]);

        if (! $review) {
            abort(404);
        }

        $this->productReviewRepository->delete($id);

        session()->flash('success', trans('shop::app.response.delete-success', ['name' => 'Product Review']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Customer delete all reviews from their account
     *
     * @return \Illuminate\Http\Response
    */
    public function deleteAll()
    {
        $reviews = auth()->guard('customer')->user()->all_reviews;

        if ($reviews->count() > 0) {
            foreach ($reviews as $review) {
                $this->productReviewRepository->delete($review->id);
            }
        }

        session()->flash('success', trans('shop::app.reviews.delete-all'));

        return redirect()->route($this->_config['redirect']);
    }
}