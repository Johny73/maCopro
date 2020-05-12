<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LotsRepository")
 */
class Lots
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numLot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $quotePart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proprietaires", inversedBy="lots")
     */
    private $proprietaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNumLot(): ?string
    {
        return $this->numLot;
    }

    public function setNumLot(string $numLot): self
    {
        $this->numLot = $numLot;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(string $voie): self
    {
        $this->voie = $voie;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getQuotePart(): ?int
    {
        return $this->quotePart;
    }

    public function setQuotePart(int $quotePart): self
    {
        $this->quotePart = $quotePart;

        return $this;
    }

    public function getProprietaire(): ?proprietaires
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?proprietaires $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }
}
