<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JournaliersRepository")
 */
class Journaliers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_de_debut_journalier;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin_journalier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $option_journalier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activites", inversedBy="journaliers")
     */
    private $activites;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeDebutJournalier(): ?\DateTimeInterface
    {
        return $this->date_de_debut_journalier;
    }

    public function setDateDeDebutJournalier(\DateTimeInterface $date_de_debut_journalier): self
    {
        $this->date_de_debut_journalier = $date_de_debut_journalier;

        return $this;
    }

    public function getDateFinJournalier(): ?\DateTimeInterface
    {
        return $this->date_fin_journalier;
    }

    public function setDateFinJournalier(\DateTimeInterface $date_fin_journalier): self
    {
        $this->date_fin_journalier = $date_fin_journalier;

        return $this;
    }

    public function getOptionJournalier(): ?string
    {
        return $this->option_journalier;
    }

    public function setOptionJournalier(string $option_journalier): self
    {
        $this->option_journalier = $option_journalier;

        return $this;
    }

    public function getActivites(): ?Activites
    {
        return $this->activites;
    }

    public function setActivites(?Activites $activites): self
    {
        $this->activites = $activites;

        return $this;
    }
}
