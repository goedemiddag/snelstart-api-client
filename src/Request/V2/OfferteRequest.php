<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Model\Offerte;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Utils;

final class OfferteRequest extends BaseRequest
{
    public function add(Offerte $offerte): RequestInterface
    {
        return new Request("POST", "offertes", [
            "Content-Type"  =>  "application/json"
        ], Utils::jsonEncode($this->prepareAddOrEditRequestForSerialization($offerte)));
    }
}
