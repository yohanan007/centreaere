<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationsRepository")
 */
class Associations
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
    private $nom_association;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email_association;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $telephone_association;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_association;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ville_association;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administrateur", inversedBy="associations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $administrateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activites", mappedBy="associations")
     */
    private $activites;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAssociation(): ?string
    {
        return $this->nom_association;
    }

    public function setNomAssociation(string $nom_association): self
    {
        $this->nom_association = $nom_association;

        return $this;
    }

    public function getEmailAssociation(): ?string
    {
        return $this->email_association;
    }

    public function setEmailAssociation(string $email_association): self
    {
        $this->email_association = $email_association;

        return $this;
    }

    public function getTelephoneAssociation(): ?string
    {
        return $this->telephone_association;
    }

    public function setTelephoneAssociation(string $telephone_association): self
    {
        $this->telephone_association = $telephone_association;

        return $this;
    }

    public function getAdresseAssociation(): ?string
    {
        return $this->adresse_association;
    }

    public function setAdresseAssociation(string $adresse_association): self
    {
        $this->adresse_association = $adresse_association;

        return $this;
    }

    public function getVilleAssociation(): ?string
    {
        return $this->ville_association;
    }

    public function setVilleAssociation(?string $ville_association): self
    {
        $this->ville_association = $ville_association;

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
            $activite->setAssociations($this);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getAssociations() === $this) {
                $activite->setAssociations(null);
            }
        }

        return $this;
    }
}
