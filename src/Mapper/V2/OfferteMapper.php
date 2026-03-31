<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model as Model;

final class OfferteMapper extends AbstractMapper
{
    public function add(ResponseInterface $response): Model\V2\Offerte
    {
        $this->setResponseData($response);
        return $this->mapResponseToOfferteModel(new Model\V2\Offerte());
    }

    private function mapResponseToOfferteModel(Model\V2\Offerte $offerte, array $data = []): Model\V2\Offerte
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var \SnelstartPHP\Model\V2\Offerte $offerte
         */
        $offerte = $this->mapArrayDataToModel($offerte, $data);

        return $offerte;
    }
}
