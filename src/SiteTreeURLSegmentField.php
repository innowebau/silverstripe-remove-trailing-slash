<?php

namespace Innoweb\RemoveTrailingSlash;

use SilverStripe\CMS\Forms\SiteTreeURLSegmentField as BaseSiteTreeURLSegmentField;

class SiteTreeURLSegmentField extends BaseSiteTreeURLSegmentField
{
    /**
     * Add trailing slash to prefix
     * @return string the url prefixes the page url segment field to show in template
     */
    public function getURLPrefix()
    {
        return rtrim($this->urlPrefix, '/') . '/';
    }
}
