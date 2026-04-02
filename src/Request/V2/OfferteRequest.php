<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Utils;

final class OfferteRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "offertes?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public function find(UuidInterface $uuid): RequestInterface
    {
        return new Request("GET", "offertes/" . $uuid->toString());
    }

    public function add(Offerte $offerte): RequestInterface
    {
        return new Request("POST", "offertes", [
            "Content-Type"  =>  "application/json"
        ], Utils::jsonEncode($this->prepareAddOrEditRequestForSerialization($offerte)));
    }
}
