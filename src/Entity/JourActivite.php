<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JourActiviteRepository")
 */
class JourActivite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $jour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\activites", inversedBy="jourActivites")
     */
    private $activites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ActivitesEnfants", mappedBy="jours")
     */
    private $activitesEnfants;

    public function __construct()
    {
        $this->activitesEnfants = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getActivites(): ?activites
    {
        return $this->activites;
    }

    public function setActivites(?activites $activites): self
    {
        $this->activites = $activites;

        return $this;
    }

    /**
     * @return Collection|ActivitesEnfants[]
     */
    public function getActivitesEnfants(): Collection
    {
        return $this->activitesEnfants;
    }

    public function addActivitesEnfant(ActivitesEnfants $activitesEnfant): self
    {
        if (!$this->activitesEnfants->contains($activitesEnfant)) {
            $this->activitesEnfants[] = $activitesEnfant;
            $activitesEnfant->addJour($this);
        }

        return $this;
    }

    public function removeActivitesEnfant(ActivitesEnfants $activitesEnfant): self
    {
        if ($this->activitesEnfants->contains($activitesEnfant)) {
            $this->activitesEnfants->removeElement($activitesEnfant);
            $activitesEnfant->removeJour($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->jour->format('Y-m-d');
    }
}
