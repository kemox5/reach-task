<?php

namespace Modules\Ads\App\Traits;

trait AdFilters
{
      private $query;

      public function filter($query)
      {
            $this->query = $query;
            $filters =  request()->input('filters');
            if ($filters && gettype($filters) == 'array') {
                  foreach ($filters as $filter => $val) {
                        if ($val && method_exists($this, 'filter_by_' . $filter))
                              $this->{'filter_by_' . $filter}($val);
                  }
            }
      }

      public function filter_by_advertiser_id($val)
      {
            $this->query->where('ads.advertiser_id', $val);
      }

      public function filter_by_tag_id($val)
      {
            $this->query->whereHas('tags', function ($q) use ($val) {
                  $q->where('tags.id', $val);
            });
      }

      public function filter_by_category_id($val)
      {
            $this->query->where('ads.category_id', $val);
      }
}
