<?php

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2\OfferteMapper;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2\OfferteRequest;

final class OfferteConnector extends BaseConnector
{
    public function find(UuidInterface $id, ?ODataRequestData $ODataRequestData = null): ?Offerte
    {
        $offerteRequest = new OfferteRequest();
        $offerteMapper = new OfferteMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();

        try {
            return $offerteMapper->find($this->connection->doRequest($offerteRequest->find($id, $ODataRequestData)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }
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
