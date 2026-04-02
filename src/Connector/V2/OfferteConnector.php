<?php

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2\OfferteMapper;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Request\V2\OfferteRequest;

final class OfferteConnector extends BaseConnector
{
    public function find(UuidInterface $id, ?ODataRequestData $ODataRequestData = null): ?Offerte
    {
        $mapper = new OfferteMapper();
        $request = new OfferteRequest();

        try {
            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(?ODataRequestDataInterface $ODataRequestData = null): iterable
    {
        $mapper = new OfferteMapper();
        $request = new OfferteRequest();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();

        return $mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData)));
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
