<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnfantsRepository")
 */
class Enfants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_enfant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom_enfant;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_de_naissance_enfant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Parents", inversedBy="enfants")
     */
    private $parents;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnfant(): ?string
    {
        return $this->nom_enfant;
    }

    public function setNomEnfant(string $nom_enfant): self
    {
        $this->nom_enfant = $nom_enfant;

        return $this;
    }

    public function getPrenomEnfant(): ?string
    {
        return $this->prenom_enfant;
    }

    public function setPrenomEnfant(string $prenom_enfant): self
    {
        $this->prenom_enfant = $prenom_enfant;

        return $this;
    }

    public function getDateDeNaissanceEnfant(): ?\DateTimeInterface
    {
        return $this->date_de_naissance_enfant;
    }

    public function setDateDeNaissanceEnfant(?\DateTimeInterface $date_de_naissance_enfant): self
    {
        $this->date_de_naissance_enfant = $date_de_naissance_enfant;

        return $this;
    }

    /**
     * @return Collection|Parents[]
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function addParent(Parents $parent): self
    {
        if (!$this->parents->contains($parent)) {
            $this->parents[] = $parent;
        }

        return $this;
    }

    public function removeParent(Parents $parent): self
    {
        if ($this->parents->contains($parent)) {
            $this->parents->removeElement($parent);
        }

        return $this;
    }
}
