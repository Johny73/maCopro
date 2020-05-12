<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietairesRepository")
 */
class Proprietaires
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $voie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telPerso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telPro;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Bic(message="Ce code BIC n'est pas valide")
     */
    private $bic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Iban(message="Ce code IBAN n'est pas valide")
     */
    private $iban;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lots", mappedBy="proprietaire")
     */
    private $lots;


    public function __construct()
    {
        $this->coproprietaires = new ArrayCollection();
        $this->lots = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom .' '. $this->prenom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        /*$this->nom = strtoupper($nom);*/
        $this->nom = mb_strtoupper($nom);

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }


    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(?string $voie): self
    {
        $this->voie = ucwords(strtolower($voie));

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = strtoupper($ville);

        return $this;
    }

    public function getTelPerso(): ?string
    {
        return $this->telPerso;
    }

    public function setTelPerso(?string $telPerso): self
    {
        $this->telPerso = $telPerso;

        return $this;
    }

    public function getTelPro(): ?string
    {
        return $this->telPro;
    }

    public function setTelPro(?string $telPro): self
    {
        $this->telPro = $telPro;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(?string $bic): self
    {
        $this->bic = MB_strtoupper($bic);

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = MB_strtoupper($iban); 

        return $this;
    }

    /**
     * @return Collection|Lots[]
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lots $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->setProprietaire($this);
        }

        return $this;
    }

    public function removeLot(Lots $lot): self
    {
        if ($this->lots->contains($lot)) {
            $this->lots->removeElement($lot);
            // set the owning side to null (unless already changed)
            if ($lot->getProprietaire() === $this) {
                $lot->setProprietaire(null);
            }
        }

        return $this;
    }

}