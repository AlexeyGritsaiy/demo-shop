<?php

namespace App\UseCases\Adverts;

use Illuminate\Contracts\Pagination\Paginator;

class SearchResult
{
    public $adverts;
    public $categoriesCounts;

    public function __construct(Paginator $adverts, array $categoriesCounts)
    {
        $this->adverts = $adverts;
        $this->categoriesCounts = $categoriesCounts;
    }
}
