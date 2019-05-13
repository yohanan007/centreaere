<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagesRepository")
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objet_message;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu_message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messages")
     */
    private $proprietaire_message;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="messages_destinataires")
     */
    private $destinataire_message;

    public function __construct()
    {
        $this->destinataire_message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetMessage(): ?string
    {
        return $this->objet_message;
    }

    public function setObjetMessage(string $objet_message): self
    {
        $this->objet_message = $objet_message;

        return $this;
    }

    public function getContenuMessage(): ?string
    {
        return $this->contenu_message;
    }

    public function setContenuMessage(string $contenu_message): self
    {
        $this->contenu_message = $contenu_message;

        return $this;
    }

    public function getProprietaireMessage(): ?User
    {
        return $this->proprietaire_message;
    }

    public function setProprietaireMessage(?User $proprietaire_message): self
    {
        $this->proprietaire_message = $proprietaire_message;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getDestinataireMessage(): Collection
    {
        return $this->destinataire_message;
    }

    public function addDestinataireMessage(User $destinataireMessage): self
    {
        if (!$this->destinataire_message->contains($destinataireMessage)) {
            $this->destinataire_message[] = $destinataireMessage;
        }

        return $this;
    }

    public function removeDestinataireMessage(User $destinataireMessage): self
    {
        if ($this->destinataire_message->contains($destinataireMessage)) {
            $this->destinataire_message->removeElement($destinataireMessage);
        }

        return $this;
    }
}
