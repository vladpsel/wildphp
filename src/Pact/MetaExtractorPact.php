<?php

namespace Voopsc\Wild\Pact;

interface MetaExtractorPact
{

    /**
     * Get meta title, description, keywords
     * @return array|null
     */
    public function getMetaData(): ?array;
    
}