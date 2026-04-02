<?php

namespace SnelstartPHP\Tests\Request\V2;

use PHPUnit\Framework\TestCase;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderStatus;
use SnelstartPHP\Model\V2\Offerte;
use SnelstartPHP\Request\V2\OfferteRequest;

class OfferteRequestTest extends TestCase
{
    private $offerteRequest;

    public function setUp(): void {
        $this->offerteRequest = new OfferteRequest();
    }

    public function testAddOfferteHasProcesStatusOfferte(): void {
        $offerte = new Offerte();
        $offerte->setProcesStatus(ProcesStatus::OFFERTE());

        $expected = [
            'relatie' => null,
            'procesStatus' => ProcesStatus::OFFERTE(),
            'nummer' => null,
            'modifiedOn' => null,
            'datum' => null,
            'krediettermijn' => null,
            'omschrijving' => null,
            'betalingskenmerk' => null,
            'incassomachtiging' => null,
            'afleveradres' => null,
            'factuuradres' => null,
            'verkooporderBtwIngaveModel' => null,
            'kostenplaats' => null,
            'regels' => null,
            'memo' => null,
            'orderreferentie' => null,
            'factuurkorting' => null,
            'verkoopfactuur' => null,
            'totaalExclusiefBtw' => '0.00',
            'totaalInclusiefBtw' => '0.00',
            'isOfferte' => true,
        ];
        $request = $this->offerteRequest->add($offerte);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals(json_encode($expected), $request->getBody()->getContents());
    }
}
