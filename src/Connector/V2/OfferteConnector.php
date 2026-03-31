<?php

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model as Model;
use SnelstartPHP\Request\V2 as Request;

final class OfferteConnector extends BaseConnector
{
    public function add(Model\V2\Offerte $offerte): Model\V2\Offerte
    {
        if ($offerte->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $mapper = new Mapper\OfferteMapper();
        $request = new Request\OfferteRequest();

        return $mapper->add($this->connection->doRequest($request->add($offerte)));
    }
}
