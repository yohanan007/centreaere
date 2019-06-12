<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitesRepository")
 */
class Activites
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
    private $nom_activite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeActivites", inversedBy="activites")
     */
    private $typeactivites;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Associations", inversedBy="activites")
     */
    private $associations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administrateur", inversedBy="activites")
     */
    private $administrateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journaliers", mappedBy="activites")
     */
    private $journaliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenementiels", mappedBy="activites")
     */
    private $evenementiels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="activite")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Enfants", mappedBy="activites")
     */
    private $enfants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivitesEnfants", mappedBy="activites")
     */
    private $activitesEnfants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JourActivite", mappedBy="activites")
     */
    private $jourActivites;

    public function __construct()
    {
        $this->journaliers = new ArrayCollection();
        $this->evenementiels = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->enfants = new ArrayCollection();
        $this->activitesEnfants = new ArrayCollection();
        $this->jourActivites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomActivite(): ?string
    {
        return $this->nom_activite;
    }

    public function setNomActivite(string $nom_activite): self
    {
        $this->nom_activite = $nom_activite;

        return $this;
    }

    public function getTypeactivites(): ?TypeActivites
    {
        return $this->typeactivites;
    }

    public function setTypeactivites(?TypeActivites $typeactivites): self
    {
        $this->typeactivites = $typeactivites;

        return $this;
    }

    public function getAssociations(): ?Associations
    {
        return $this->associations;
    }

    public function setAssociations(?Associations $associations): self
    {
        $this->associations = $associations;

        return $this;
    }

    public function getAdministrateurs(): ?Administrateur
    {
        return $this->administrateurs;
    }

    public function setAdministrateurs(?Administrateur $administrateurs): self
    {
        $this->administrateurs = $administrateurs;

        return $this;
    }

    /**
     * @return Collection|Journaliers[]
     */
    public function getJournaliers(): Collection
    {
        return $this->journaliers;
    }

    public function addJournalier(Journaliers $journalier): self
    {
        if (!$this->journaliers->contains($journalier)) {
            $this->journaliers[] = $journalier;
            $journalier->setActivites($this);
        }

        return $this;
    }

    public function removeJournalier(Journaliers $journalier): self
    {
        if ($this->journaliers->contains($journalier)) {
            $this->journaliers->removeElement($journalier);
            // set the owning side to null (unless already changed)
            if ($journalier->getActivites() === $this) {
                $journalier->setActivites(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenementiels[]
     */
    public function getEvenementiels(): Collection
    {
        return $this->evenementiels;
    }

    public function addEvenementiel(Evenementiels $evenementiel): self
    {
        if (!$this->evenementiels->contains($evenementiel)) {
            $this->evenementiels[] = $evenementiel;
            $evenementiel->setActivites($this);
        }

        return $this;
    }

    public function removeEvenementiel(Evenementiels $evenementiel): self
    {
        if ($this->evenementiels->contains($evenementiel)) {
            $this->evenementiels->removeElement($evenementiel);
            // set the owning side to null (unless already changed)
            if ($evenementiel->getActivites() === $this) {
                $evenementiel->setActivites(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setActivite($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getActivite() === $this) {
                $image->setActivite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enfants[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfants $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->addActivite($this);
        }

        return $this;
    }

    public function removeEnfant(Enfants $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            $enfant->removeActivite($this);
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
            $activitesEnfant->setActivites($this);
        }

        return $this;
    }

    public function removeActivitesEnfant(ActivitesEnfants $activitesEnfant): self
    {
        if ($this->activitesEnfants->contains($activitesEnfant)) {
            $this->activitesEnfants->removeElement($activitesEnfant);
            // set the owning side to null (unless already changed)
            if ($activitesEnfant->getActivites() === $this) {
                $activitesEnfant->setActivites(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JourActivite[]
     */
    public function getJourActivites(): Collection
    {
        return $this->jourActivites;
    }

    public function addJourActivite(JourActivite $jourActivite): self
    {
        if (!$this->jourActivites->contains($jourActivite)) {
            $this->jourActivites[] = $jourActivite;
            $jourActivite->setActivites($this);
        }

        return $this;
    }

    public function removeJourActivite(JourActivite $jourActivite): self
    {
        if ($this->jourActivites->contains($jourActivite)) {
            $this->jourActivites->removeElement($jourActivite);
            // set the owning side to null (unless already changed)
            if ($jourActivite->getActivites() === $this) {
                $jourActivite->setActivites(null);
            }
        }

        return $this;
    }
}
