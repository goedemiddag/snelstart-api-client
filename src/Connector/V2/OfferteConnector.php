<?php

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\V2\OfferteMapper;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Request\V2\OfferteRequest;

final class OfferteConnector extends BaseConnector
{
    public function add(Offerte $offerte): Offerte
    {
        if ($offerte->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $mapper = new OfferteMapper();
        $request = new OfferteRequest();

        return $mapper->add($this->connection->doRequest($request->add($offerte)));
    }
}
