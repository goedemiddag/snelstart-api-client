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
use SnelstartPHP\Model\V2\Artikel;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Verkoopfactuur;
use SnelstartPHP\Model\V2\VerkooporderRegel;

final class OfferteMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): ?Offerte
    {
        $this->setResponseData($response);
        return $this->map(new Offerte());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers();
    }

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
        $offerte = $this->map($offerte, $data);

        return $offerte;
    }

    public function map(Offerte $offerte, array $data = []): Offerte
    {
        $data = empty($data) ? $this->responseData : $data;
        $adresMapper = new AdresMapper();

        /**
         * @var Offerte $offerte
         */
        $offerte = $this->mapArrayDataToModel($offerte, $data);
        $offerte->setRelatie(Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])))
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
            return (new VerkooporderRegel())
                ->setArtikel(Artikel::createFromUUID(Uuid::fromString($data["artikel"]["id"])))
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
            $offerte->setVerkoopfactuur(Verkoopfactuur::createFromUUID(Uuid::fromString($data["verkoopfactuur"])));
        }

        if ($data["verkooporderBtwIngaveModel"] !== null) {
            $offerte->setVerkooporderBtwIngaveModel(VerkooporderBtwIngave::from($data["verkooporderBtwIngaveModel"]));
        }

        return $offerte;
    }

    /**
     * Map many results to the mapper.
     *
     * @return \Generator
     */
    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $offerteData) {
            yield $this->mapResponseToOfferteModel(new Offerte(), $offerteData);
        }
    }
}
