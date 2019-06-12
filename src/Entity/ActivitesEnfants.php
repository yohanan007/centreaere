<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitesEnfantsRepository")
 */
class ActivitesEnfants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enfants", inversedBy="activitesEnfants")
     */
    private $enfants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activites", inversedBy="activitesEnfants")
     */
    private $activites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\JourActivite", inversedBy="activitesEnfants")
     */
    private $jours;

   

    public function __construct()
    {
        $this->jours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(?bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getEnfants(): ?Enfants
    {
        return $this->enfants;
    }

    public function setEnfants(?Enfants $enfants): self
    {
        $this->enfants = $enfants;

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

    /**
     * @return Collection|JourActivite[]
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(JourActivite $jour): self
    {
        if (!$this->jours->contains($jour)) {
            $this->jours[] = $jour;
        }

        return $this;
    }

    public function removeJour(JourActivite $jour): self
    {
        if ($this->jours->contains($jour)) {
            $this->jours->removeElement($jour);
        }

        return $this;
    }

    

}
