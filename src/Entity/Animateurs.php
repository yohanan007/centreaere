<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimateursRepository")
 */
class Animateurs
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
    private $nom_animateur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom_animateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administrateur", inversedBy="animateurs")
     */
    private $administrateurs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDeNaissance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimateur(): ?string
    {
        return $this->nom_animateur;
    }

    public function setNomAnimateur(string $nom_animateur): self
    {
        $this->nom_animateur = $nom_animateur;

        return $this;
    }

    public function getPrenomAnimateur(): ?string
    {
        return $this->prenom_animateur;
    }

    public function setPrenomAnimateur(string $prenom_animateur): self
    {
        $this->prenom_animateur = $prenom_animateur;

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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->DateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $DateDeNaissance): self
    {
        $this->DateDeNaissance = $DateDeNaissance;

        return $this;
    }
}
