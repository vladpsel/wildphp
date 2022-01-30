<?php

namespace Voopsc\Wild\Helper;

use Voopsc\Wild\Pact\MetaExtractorPact;

class MetaExtractor implements MetaExtractorPact
{

    public function getMetaData(): ?array
    {
        return [];
    }
}