<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\Offerte;

final class OfferteMapper extends AbstractMapper
{
    public function add(ResponseInterface $response): Offerte
    {
        $this->setResponseData($response);
        return $this->mapResponseToOfferteModel(new Offerte());
    }

    private function mapResponseToOfferteModel(Offerte $offerte, array $data = []): Offerte
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var Offerte $offerte
         */
        $offerte = $this->mapArrayDataToModel($offerte, $data);

        return $offerte;
    }
}
