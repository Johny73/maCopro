<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComptesRepository")
 */
class Comptes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private $numCompte;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $labelCompte;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $typeCompte;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $imputLocataire;


    public function __construct()
    {
        $this->comptes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompte(): ?string
    {
        return $this->numCompte;
    }

    public function setNumCompte(string $numCompte): self
    {
        $this->numCompte = $numCompte;

        return $this;
    }

    public function getLabelCompte(): ?string
    {
        return $this->labelCompte;
    }

    public function setLabelCompte(string $labelCompte): self
    {
        $this->labelCompte = ucwords(strtolower($labelCompte));

        return $this;
    }

    public function getTypeCompte(): ?string
    {
        return $this->typeCompte;
    }

    public function setTypeCompte(string $typeCompte): self
    {
        $this->typeCompte = strtoupper($typeCompte);

        return $this;
    }

    public function getImputLocataire(): ?string
    {
        return $this->imputLocataire;
    }

    public function setImputLocataire(?string $imputLocataire): self
    {
        $this->imputLocataire = $imputLocataire;

        return $this;
    }


}