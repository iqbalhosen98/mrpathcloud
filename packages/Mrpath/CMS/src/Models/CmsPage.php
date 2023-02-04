<?php

namespace Mrpath\CMS\Models;

use Mrpath\Core\Eloquent\TranslatableModel;
use Mrpath\CMS\Contracts\CmsPage as CmsPageContract;
use Mrpath\Core\Models\ChannelProxy;

class CmsPage extends TranslatableModel implements CmsPageContract
{
    protected $fillable = ['layout'];

    public $translatedAttributes = [
        'content',
        'meta_description',
        'meta_title',
        'page_title',
        'meta_keywords',
        'html_content',
        'url_key',
    ];

    protected $with = ['translations'];

    /**
     * Get the channels.
     */
    public function channels()
    {
        return $this->belongsToMany(ChannelProxy::modelClass(), 'cms_page_channels');
    }
}