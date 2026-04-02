<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngave;
use SnelstartPHP\Model\V2;

final class OfferteMapper extends AbstractMapper
{
    public function add(ResponseInterface $response): V2\Offerte
    {
        $this->setResponseData($response);
        return $this->mapResponseToOfferteModel(new V2\Offerte());
    }

    private function mapResponseToOfferteModel(V2\Offerte $offerte, array $data = []): V2\Offerte
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var V2\Offerte $offerte
         */
        $offerte = $this->map($offerte, $data);

        return $offerte;
    }

    public function map(V2\Offerte $offerte, array $data = []): V2\Offerte
    {
        $data = empty($data) ? $this->responseData : $data;
        $adresMapper = new AdresMapper();

        /**
         * @var V2\Offerte $offerte
         */
        $offerte = $this->mapArrayDataToModel($offerte, $data);
        $offerte->setRelatie(V2\Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])))
            ->setProcesStatus(new ProcesStatus($data["procesStatus"]));

        if ($data["incassomachtiging"] !== null) {
            $offerte->setIncassomachtiging(IncassoMachtiging::createFromUUID(Uuid::fromString($data["incassomachtiging"]["id"])));
        }

        if ($data["afleveradres"] !== null) {
            $offerte->setAfleveradres($adresMapper->mapAdresToSnelstartObject($data["afleveradres"]));
        }

        if ($data["factuuradres"] !== null) {
            $offerte->setFactuuradres($adresMapper->mapAdresToSnelstartObject($data["factuuradres"]));
        }

        if ($data["kostenplaats"] !== null) {
            $offerte->setKostenplaats(Kostenplaats::createFromUUID(Uuid::fromString($data["kostenplaats"]["id"])));
        }

        $regels = array_map(function(array $data) {
            return (new V2\VerkooporderRegel())
                ->setArtikel(V2\Artikel::createFromUUID(Uuid::fromString($data["artikel"]["id"])))
                ->setOmschrijving($data["omschrijving"])
                ->setStuksprijs($this->getMoney($data["stuksprijs"]))
                ->setAantal($data["aantal"])
                ->setKortingsPercentage($data["kortingsPercentage"])
                ->setTotaal($this->getMoney($data["totaal"]))
                ;
        }, $data["regels"]);

        $offerte->setRegels(...$regels);

        if ($data["factuurkorting"] !== null) {
            $offerte->setFactuurkorting($this->getMoney($data["factuurkorting"]));
        }

        if ($data["totaalExclusiefBtw"] !== null) {
            $offerte->setTotaalExclusiefBtw($this->getMoney($data["totaalExclusiefBtw"]));
        }

        if ($data["totaalInclusiefBtw"] !== null) {
            $offerte->setTotaalInclusiefBtw($this->getMoney($data["totaalInclusiefBtw"]));
        }

        if ($data["verkoopfactuur"] !== null) {
            $offerte->setVerkoopfactuur(V2\Verkoopfactuur::createFromUUID(Uuid::fromString($data["verkoopfactuur"])));
        }

        if ($data["verkooporderBtwIngaveModel"] !== null) {
            $offerte->setVerkooporderBtwIngaveModel(VerkooporderBtwIngave::from($data["verkooporderBtwIngaveModel"]));
        }

        return $offerte;
    }
}
