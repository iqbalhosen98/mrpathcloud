<?php

namespace Mrpath\Product\Repositories;

use Illuminate\Http\UploadedFile;
use Mrpath\Core\Eloquent\Repository;
use Illuminate\Container\Container as App;

class ProductReviewImageRepository extends Repository
{
    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Container\Container  $app
     *
     * @return void
     */
    public function __construct(App $app) {
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Mrpath\Product\Contracts\ProductReviewImage';
    }

    /**
     * @param  array  $data
     * @param  \Mrpath\Product\Contracts\ProductReview  $review
     * @return void
     */
    public function uploadImages($data, $review)
    {
        if (isset($data['attachments'])) {
            foreach ($data['attachments'] as $imageId => $image) {
                $file = 'attachments.' . $imageId;
                $dir = 'review/' . $review->id;

                if ($image instanceof UploadedFile) {
                    if (request()->hasFile($file)) {
                        $this->create([
                            'path'      => request()->file($file)->store($dir),
                            'review_id' => $review->id,
                        ]);
                    }
                }
            }
        }
    }
}