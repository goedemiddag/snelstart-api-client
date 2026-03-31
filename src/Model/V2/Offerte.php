<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Snelstart;

final class Offerte extends SnelstartObject
{
    /**
     * @var Model\Relatie
     */
    private $relatie;

    /**
     * Status van de order
     *
     * @var ProcesStatus|null
     */
    private $procesStatus;

    /**
     * Het ordernummer
     *
     * @var int
     */
    private $nummer;

    /**
     * Datum waarop de gegevens van deze relatie zijn aangepast
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * Orderdatum
     *
     * @var \DateTimeInterface
     */
    private $datum;

    /**
     * de krediettermijn (in dagen) van de offerte
     *
     * @var int
     */
    private $krediettermijn;

    /**
     * Omschrijving van de order
     *
     * @var string
     */
    private $omschrijving;

    /**
     * Betalingskenmerk van de order
     *
     * @var string
     */
    private $betalingskenmerk;

    /**
     * Incassomachtiging
     *
     * @var IncassoMachtiging
     */
    private $incassomachtiging;

    /**
     * het afleveradres van de order
     *
     * @var Adres
     */
    private $afleveradres;

    /**
     * het factuuradres van de order
     *
     * @var Adres
     */
    private $factuuradres;

    /**
     * @var string
     */
    private $verkooporderBtwIngaveModel;

    /**
     * Kostenplaats referentie
     *
     * @var Kostenplaats
     */
    private $kostenplaats;

    /**
     * @var VerkooporderRegel[]|null
     */
    private $regels;

    /**
     * @var string
     */

    private $memo;

    /**
     * orderreferentie van de offerte
     *
     * @var string
     */
    private $orderreferentie;

    /**
     * factuurkorting
     *
     * @var float
     */
    private $factuurkorting;

    /**
     * verkoopfactuur
     *
     * @var Model\Verkoopfactuur
     */
    private $verkoopfactuur;

    /**
     * @var Money|null
     */
    private $totaalExclusiefBtw;

    /**
     * @var Money|null
     */
    private $totaalInclusiefBtw;

    /**
     * @var bool
     */
    private $isOfferte = true;

    /**
     * Public identifier
     *
     * @var UuidInterface
     */
    protected $id;

    /**
     * uri van het object
     *
     * @var string
     */
    protected $uri;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        'relatie',
        'procesStatus',
        'nummer',
        'modifiedOn',
        'datum',
        'krediettermijn',
        'omschrijving',
        'betalingskenmerk',
        'afleveradres',
        'factuuradres',
        'verkooporderBtwIngaveModel',
        'kostenplaats',
        'regels',
        'memo',
        'orderreferentie',
        'factuurkorting',
        'verkoopfactuur',
        'totaalExclusiefBtw',
        'totaalInclusiefBtw',
        'isOfferte',
    ];

    public function getRelatie(): Model\Relatie
    {
        return $this->relatie;
    }

    public function setRelatie(Model\Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    public function getProcesStatus(): ?ProcesStatus
    {
        return $this->procesStatus;
    }

    public function setProcesStatus(?ProcesStatus $procesStatus): self
    {
        $this->procesStatus = $procesStatus;

        return $this;
    }

    public function getNummer(): ?int
    {
        return $this->nummer;
    }

    public function setNummer(?int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getDatum(): \DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKrediettermijn(): ?string
    {
        return $this->krediettermijn;
    }

    public function setKrediettermijn(?string $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getBetalingskenmerk(): ?string
    {
        return $this->betalingskenmerk;
    }

    public function setBetalingskenmerk(?string $betalingskenmerk): self
    {
        $this->betalingskenmerk = $betalingskenmerk;

        return $this;
    }

    public function getAfleveradres(): ?Adres
    {
        return $this->afleveradres;
    }

    public function setAfleveradres(?Adres $afleveradres): self
    {
        $this->afleveradres = $afleveradres;

        return $this;
    }

    public function getFactuuradres(): ?Adres
    {
        return $this->factuuradres;
    }

    public function setFactuuradres(?Adres $factuuradres): self
    {
        $this->factuuradres = $factuuradres;

        return $this;
    }

    public function getVerkooporderBtwIngaveModel(): ?string
    {
        return $this->verkooporderBtwIngaveModel;
    }

    public function setVerkooporderBtwIngaveModel(?string $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }

    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(?Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return VerkooporderRegel[]|null
     */
    public function getRegels(): ?iterable
    {
        return $this->regels;
    }

    public function setRegels(VerkooporderRegel ...$regels): self
    {
        $this->regels = $regels;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getOrderreferentie(): ?string
    {
        return $this->orderreferentie;
    }

    public function setOrderreferentie(?string $orderreferentie): self
    {
        $this->orderreferentie = $orderreferentie;

        return $this;
    }

    public function getFactuurkorting(): ?string
    {
        return $this->factuurkorting;
    }

    public function setFactuurkorting(?string $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    public function getVerkoopfactuur(): ?Model\Verkoopfactuur
    {
        return $this->verkoopfactuur;
    }

    public function setVerkoopfactuur(?Model\Verkoopfactuur $verkoopfactuur): self
    {
        $this->verkoopfactuur = $verkoopfactuur;

        return $this;
    }

    public function getTotaalExclusiefBtw(): ?Money
    {
        return $this->totaalExclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalExclusiefBtw(Money $totaalExclusiefBtw): self
    {
        $this->totaalExclusiefBtw = $totaalExclusiefBtw;

        return $this;
    }

    public function getTotaalInclusiefBtw(): ?Money
    {
        return $this->totaalInclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalInclusiefBtw(Money $totaalInclusiefBtw): self
    {
        $this->totaalInclusiefBtw = $totaalInclusiefBtw;

        return $this;
    }

    public function getIsOfferte(): bool
    {
        return $this->isOfferte;
    }

    public function setIsOfferte(?bool $isOfferte = true): self
    {
        $this->isOfferte = $isOfferte;

        return $this;
    }
}
