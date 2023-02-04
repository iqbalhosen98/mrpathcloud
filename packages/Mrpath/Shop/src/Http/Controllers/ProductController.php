<?php

namespace Mrpath\Shop\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Mrpath\Attribute\Repositories\AttributeRepository;
use Mrpath\Category\Repositories\CategoryRepository;
use Mrpath\Product\Repositories\ProductAttributeValueRepository;
use Mrpath\Product\Repositories\ProductDownloadableLinkRepository;
use Mrpath\Product\Repositories\ProductDownloadableSampleRepository;
use Mrpath\Product\Repositories\ProductFlatRepository;
use Mrpath\Product\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Product repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * Product flat repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductFlatRepository
     */
    protected $productFlatRepository;

    /**
     * Product attribute value repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductAttributeValueRepository
     */
    protected $productAttributeValueRepository;

    /**
     * Product downloadable sample repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductDownloadableSampleRepository
     */
    protected $productDownloadableSampleRepository;

    /**
     * Product downloadable link repository instance.
     *
     * @var \Mrpath\Product\Repositories\ProductDownloadableLinkRepository
     */
    protected $productDownloadableLinkRepository;

    /**
     * Category repository instance.
     *
     * @var \Mrpath\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\Product\Repositories\ProductRepository  $productRepository
     * @param  \Mrpath\Product\Repositories\ProductFlatRepository  $productFlatRepository
     * @param  \Mrpath\Product\Repositories\ProductAttributeValueRepository  $productAttributeValueRepository
     * @param  \Mrpath\Product\Repositories\ProductDownloadableSampleRepository  $productDownloadableSampleRepository
     * @param  \Mrpath\Product\Repositories\ProductDownloadableLinkRepository  $productDownloadableLinkRepository
     * @param  \Mrpath\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductFlatRepository $productFlatRepository,
        ProductAttributeValueRepository $productAttributeValueRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;

        $this->productFlatRepository = $productFlatRepository;

        $this->productAttributeValueRepository = $productAttributeValueRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }

    /**
     * Download image or file.
     *
     * @param  int  $productId
     * @param  int  $attributeId
     * @return \Illuminate\Http\Response
     */
    public function download($productId, $attributeId)
    {
        $productAttribute = $this->productAttributeValueRepository->findOneWhere([
            'product_id'   => $productId,
            'attribute_id' => $attributeId,
        ]);

        return isset($productAttribute['text_value'])
            ? Storage::download($productAttribute['text_value'])
            : null;
    }

    /**
     * Download the for the specified resource.
     *
     * @return \Illuminate\Http\Response|\Exception
     */
    public function downloadSample()
    {
        try {
            if (request('type') == 'link') {
                $productDownloadableLink = $this->productDownloadableLinkRepository->findOrFail(request('id'));

                if ($productDownloadableLink->sample_type == 'file') {
                    $privateDisk = Storage::disk('private');

                    return $privateDisk->exists($productDownloadableLink->sample_file)
                        ? $privateDisk->download($productDownloadableLink->sample_file)
                        : abort(404);
                } else {
                    $fileName = substr($productDownloadableLink->sample_url, strrpos($productDownloadableLink->sample_url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableLink->sample_url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            } else {
                $productDownloadableSample = $this->productDownloadableSampleRepository->findOrFail(request('id'));

                if ($productDownloadableSample->type == 'file') {
                    return Storage::download($productDownloadableSample->file);
                } else {
                    $fileName = substr($productDownloadableSample->url, strrpos($productDownloadableSample->url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableSample->url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get filter attributes for product.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFilterAttributes($categoryId = null, AttributeRepository $attributeRepository)
    {
        $filterAttributes = [];

        if ($category = $this->categoryRepository->find($categoryId)) {
            $filterAttributes = $this->productFlatRepository->getFilterAttributes($category);
        }

        if (! count($filterAttributes) > 0) {
            $filterAttributes = $attributeRepository->getFilterAttributes();
        }

        return response()->json([
            'filter_attributes' => $filterAttributes,
        ]);
    }

    /**
     * Get category product maximum price.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoryProductMaximumPrice($categoryId = null)
    {
        $maxPrice = 0;

        if ($category = $this->categoryRepository->find($categoryId)) {
            $maxPrice = $this->productFlatRepository->handleCategoryProductMaximumPrice($category);
        }

        return response()->json([
            'max_price' => $maxPrice,
        ]);
    }
}
