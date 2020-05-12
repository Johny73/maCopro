<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JournalRepository")
 */
class Journal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=false)
     * @Assert\LessThanOrEqual("today", message="La date ne peut pas être supérieur à aujourd'hui")

     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Comptes")
     */
    private $compteDebit;

    /**
     * @ORM\ManyToOne(targetEntity="Comptes")
     */
    private $compteCredit;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Regex(pattern="/^[0-9]+$/", message="Merci de ne que saisir des nombres")
     */
    private $montant;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompteDebit(): ?Comptes
    {
        return $this->compteDebit;
    }


      public function setCompteDebit(?Comptes $compteDebit): self
    {
        $this->compteDebit = $compteDebit;

        return $this;
    }

    public function getCompteCredit(): ?Comptes
    {
        return $this->compteCredit;
    }

    public function setCompteCredit(?Comptes $compteCredit): self
    {
        $this->compteCredit = $compteCredit;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
