<?php

namespace Mrpath\Category\Observers;

use Illuminate\Support\Facades\Storage;
use Mrpath\Category\Models\Category;
use Carbon\Carbon;

class CategoryObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Mrpath\Category\Contracts\Category  $category
     * @return void
     */
    public function deleted($category)
    {
        Storage::deleteDirectory('category/' . $category->id);
    }

    /**
     * Handle the Category "saved" event.
     *
     * @param  \Mrpath\Category\Contracts\Category  $category
     */
    public function saved($category)
    {
        foreach ($category->children as $child) {
            $child->touch();
        }
    }
}