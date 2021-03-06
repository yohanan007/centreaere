<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentsRepository")
 */
class Parents
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
    private $nom_parent;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom_parent;

  



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Enfants", mappedBy="parents")
     */
    private $enfants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ParentsAssociations", mappedBy="parents")
     */
    private $parentsAssociations;

    public function __construct()
    {

        $this->enfants = new ArrayCollection();
        $this->parentsAssociations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomParent(): ?string
    {
        return $this->nom_parent;
    }

    public function setNomParent(string $nom_parent): self
    {
        $this->nom_parent = $nom_parent;

        return $this;
    }

    public function getPrenomParent(): ?string
    {
        return $this->prenom_parent;
    }

    public function setPrenomParent(string $prenom_parent): self
    {
        $this->prenom_parent = $prenom_parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(self $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
        }

        return $this;
    }

    public function removeAssociation(self $association): self
    {
        if ($this->associations->contains($association)) {
            $this->associations->removeElement($association);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function addParent(self $parent): self
    {
        if (!$this->parents->contains($parent)) {
            $this->parents[] = $parent;
            $parent->addAssociation($this);
        }

        return $this;
    }

    public function removeParent(self $parent): self
    {
        if ($this->parents->contains($parent)) {
            $this->parents->removeElement($parent);
            $parent->removeAssociation($this);
        }

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

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
            $enfant->addParent($this);
        }

        return $this;
    }

    public function removeEnfant(Enfants $enfant): self
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            $enfant->removeParent($this);
        }

        return $this;
    }

    /**
     * @return Collection|ParentsAssociations[]
     */
    public function getParentsAssociations(): Collection
    {
        return $this->parentsAssociations;
    }

    public function addParentsAssociation(ParentsAssociations $parentsAssociation): self
    {
        if (!$this->parentsAssociations->contains($parentsAssociation)) {
            $this->parentsAssociations[] = $parentsAssociation;
            $parentsAssociation->setParents($this);
        }

        return $this;
    }

    public function removeParentsAssociation(ParentsAssociations $parentsAssociation): self
    {
        if ($this->parentsAssociations->contains($parentsAssociation)) {
            $this->parentsAssociations->removeElement($parentsAssociation);
            // set the owning side to null (unless already changed)
            if ($parentsAssociation->getParents() === $this) {
                $parentsAssociation->setParents(null);
            }
        }

        return $this;
    }
}
