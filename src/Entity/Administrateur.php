<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministrateurRepository")
 */
class Administrateur
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
    private $nom_administrateur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom_administrateur;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_de_naissance_administrateur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email_administrateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_administrateur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ville_administrateur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pays_administrateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Associations", mappedBy="administrateurs")
     */
    private $associations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Animateurs", mappedBy="administrateurs")
     */
    private $animateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Activites", mappedBy="administrateurs")
     */
    private $activites;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
        $this->animateurs = new ArrayCollection();
        $this->activites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdministrateur(): ?string
    {
        return $this->nom_administrateur;
    }

    public function setNomAdministrateur(string $nom_administrateur): self
    {
        $this->nom_administrateur = $nom_administrateur;

        return $this;
    }

    public function getPrenomAdministrateur(): ?string
    {
        return $this->prenom_administrateur;
    }

    public function setPrenomAdministrateur(string $prenom_administrateur): self
    {
        $this->prenom_administrateur = $prenom_administrateur;

        return $this;
    }

    public function getDateDeNaissanceAdministrateur(): ?\DateTimeInterface
    {
        return $this->date_de_naissance_administrateur;
    }

    public function setDateDeNaissanceAdministrateur(?\DateTimeInterface $date_de_naissance_administrateur): self
    {
        $this->date_de_naissance_administrateur = $date_de_naissance_administrateur;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmailAdministrateur(): ?string
    {
        return $this->email_administrateur;
    }

    public function setEmailAdministrateur(?string $email_administrateur): self
    {
        $this->email_administrateur = $email_administrateur;

        return $this;
    }

    public function getAdresseAdministrateur(): ?string
    {
        return $this->adresse_administrateur;
    }

    public function setAdresseAdministrateur(?string $adresse_administrateur): self
    {
        $this->adresse_administrateur = $adresse_administrateur;

        return $this;
    }

    public function getVilleAdministrateur(): ?string
    {
        return $this->ville_administrateur;
    }

    public function setVilleAdministrateur(?string $ville_administrateur): self
    {
        $this->ville_administrateur = $ville_administrateur;

        return $this;
    }

    public function getPaysAdministrateur(): ?string
    {
        return $this->pays_administrateur;
    }

    public function setPaysAdministrateur(?string $pays_administrateur): self
    {
        $this->pays_administrateur = $pays_administrateur;

        return $this;
    }

    /**
     * @return Collection|Associations[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Associations $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->setAdministrateurs($this);
        }

        return $this;
    }

    public function removeAssociation(Associations $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
            // set the owning side to null (unless already changed)
            if ($association->getAdministrateurs() === $this) {
                $association->setAdministrateurs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Animateurs[]
     */
    public function getAnimateurs(): Collection
    {
        return $this->animateurs;
    }

    public function addAnimateur(Animateurs $animateur): self
    {
        if (!$this->animateurs->contains($animateur)) {
            $this->animateurs[] = $animateur;
            $animateur->setAdministrateurs($this);
        }

        return $this;
    }

    public function removeAnimateur(Animateurs $animateur): self
    {
        if ($this->animateurs->contains($animateur)) {
            $this->animateurs->removeElement($animateur);
            // set the owning side to null (unless already changed)
            if ($animateur->getAdministrateurs() === $this) {
                $animateur->setAdministrateurs(null);
            }
        }

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
            $activite->setAdministrateurs($this);
        }

        return $this;
    }

    public function removeActivite(Activites $activite): self
    {
        if ($this->activites->contains($activite)) {
            $this->activites->removeElement($activite);
            // set the owning side to null (unless already changed)
            if ($activite->getAdministrateurs() === $this) {
                $activite->setAdministrateurs(null);
            }
        }

        return $this;
    }
}
