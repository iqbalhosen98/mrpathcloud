<?php

namespace Mrpath\Product;

use Illuminate\Support\Facades\Storage;
use Mrpath\Product\Helpers\AbstractProduct;

class ProductVideo extends AbstractProduct
{
    /**
     * Retrieve collection of videos
     *
     * @param  \Mrpath\Product\Contracts\Product|\Mrpath\Product\Contracts\ProductFlat  $product
     * @return array
     */
    public function getVideos($product)
    {
        if (! $product) {
            return [];
        }

        $videos = [];

        foreach ($product->videos as $video) {
            if (! Storage::has($video->path)) {
                continue;
            }

            $videos[] = [
                'type' => $video->type,
                'video_url'    => Storage::url($video->path),
            ];
        }

        return $videos;
    }
}