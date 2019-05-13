<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementielsRepository")
 */
class Evenementiels
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
    private $date_evenementiel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activites", inversedBy="evenementiels")
     */
    private $activites;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEvenementiel(): ?\DateTimeInterface
    {
        return $this->date_evenementiel;
    }

    public function setDateEvenementiel(\DateTimeInterface $date_evenementiel): self
    {
        $this->date_evenementiel = $date_evenementiel;

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
