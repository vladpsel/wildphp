<?php

declare(strict_types=1);

namespace Voopsc\Wild\Response;

class JSONData
{

    public function toJson($data = []): self
    {
        $response = json_encode($data, JSON_UNESCAPED_UNICODE);
        header('Content-Type: application/json; charset=utf-8');
        echo $response;
        return $this;
    }

}