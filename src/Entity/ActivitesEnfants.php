<?php

namespace App\Entity;

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
}
