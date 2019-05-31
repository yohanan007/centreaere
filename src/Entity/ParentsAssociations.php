<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentsAssociationsRepository")
 * @ORM\Table(name="parent_association")
 */
class ParentsAssociations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parents", inversedBy="parentsAssociations")
     */
    private $parents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Associations", inversedBy="parentsAssociations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $associations;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParents(): ?Parents
    {
        return $this->parents;
    }

    public function setParents(?Parents $parents): self
    {
        $this->parents = $parents;

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

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(?bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }
}
