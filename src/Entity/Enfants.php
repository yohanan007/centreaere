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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activites", inversedBy="enfants")
     */
    private $activites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivitesEnfants", mappedBy="enfants")
     */
    private $activitesEnfants;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
        $this->activites = new ArrayCollection();
        $this->activitesEnfants = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Activites[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activites $activite): self
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
        }

        return $this;
    }

    public function removeActivite(Activites $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
        }

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
            $activitesEnfant->setEnfants($this);
        }

        return $this;
    }

    public function removeActivitesEnfant(ActivitesEnfants $activitesEnfant): self
    {
        if ($this->activitesEnfants->contains($activitesEnfant)) {
            $this->activitesEnfants->removeElement($activitesEnfant);
            // set the owning side to null (unless already changed)
            if ($activitesEnfant->getEnfants() === $this) {
                $activitesEnfant->setEnfants(null);
            }
        }

        return $this;
    }
}
