<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model as Model;
use SnelstartPHP\Snelstart;

final class Offerte extends SnelstartObject
{
    /**
     * @var Model\V2\Relatie|null
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
     * @var int|null
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
     * @var \DateTimeInterface|null
     */
    private $datum;

    /**
     * de krediettermijn (in dagen) van de offerte
     *
     * @var int|null
     */
    private $krediettermijn;

    /**
     * Omschrijving van de order
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Betalingskenmerk van de order
     *
     * @var string|null
     */
    private $betalingskenmerk;

    /**
     * Incassomachtiging
     *
     * @var Model\IncassoMachtiging|null
     */
    private $incassomachtiging;

    /**
     * het afleveradres van de order
     *
     * @var Model\Adres|null
     */
    private $afleveradres;

    /**
     * het factuuradres van de order
     *
     * @var Model\Adres|null
     */
    private $factuuradres;

    /**
     * @var Model\Type\VerkooporderBtwIngave|null
     */
    private $verkooporderBtwIngaveModel;

    /**
     * Kostenplaats referentie
     *
     * @var Model\Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * @var VerkooporderRegel[]
     */
    private $regels;

    /**
     * @var string|null
     */

    private $memo;

    /**
     * orderreferentie van de offerte
     *
     * @var string|null
     */
    private $orderreferentie;

    /**
     * factuurkorting
     *
     * @var Money|null
     */
    private $factuurkorting;

    /**
     * verkoopfactuur
     *
     * @var Model\V2\Verkoopfactuur|null
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
        'incassomachtiging',
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

    public function getRelatie(): ?Model\V2\Relatie
    {
        return $this->relatie;
    }

    public function setRelatie(Model\V2\Relatie $relatie): self
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

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKrediettermijn(): ?int
    {
        return $this->krediettermijn;
    }

    public function setKrediettermijn(?int $krediettermijn): self
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

    public function getIncassomachtiging(): ?IncassoMachtiging
    {
        return $this->incassomachtiging;
    }

    public function setIncassomachtiging(?IncassoMachtiging $incassomachtiging): self
    {
        $this->incassomachtiging = $incassomachtiging;

        return $this;
    }

    public function getAfleveradres(): ?Model\Adres
    {
        return $this->afleveradres;
    }

    public function setAfleveradres(?Model\Adres $afleveradres): self
    {
        $this->afleveradres = $afleveradres;

        return $this;
    }

    public function getFactuuradres(): ?Model\Adres
    {
        return $this->factuuradres;
    }

    public function setFactuuradres(?Model\Adres $factuuradres): self
    {
        $this->factuuradres = $factuuradres;

        return $this;
    }

    public function getVerkooporderBtwIngaveModel(): ?Model\Type\VerkooporderBtwIngave
    {
        return $this->verkooporderBtwIngaveModel;
    }

    public function setVerkooporderBtwIngaveModel(Model\Type\VerkooporderBtwIngave $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }

    public function getKostenplaats(): ?Model\Kostenplaats
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(?Model\Kostenplaats $kostenplaats): self
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

    public function getFactuurkorting(): ?Money
    {
        return $this->factuurkorting;
    }

    public function setFactuurkorting(?Money $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    public function getVerkoopfactuur(): ?Model\V2\Verkoopfactuur
    {
        return $this->verkoopfactuur;
    }

    public function setVerkoopfactuur(?Model\V2\Verkoopfactuur $verkoopfactuur): self
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

    public function setIsOfferte(bool $isOfferte): self
    {
        $this->isOfferte = $isOfferte;

        return $this;
    }
}
