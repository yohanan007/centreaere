<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $rols;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="proprietaire_message")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Messages", mappedBy="destinataire_message")
     */
    private $messages_destinataires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="user")
     */
    private $images;

    public function __construct()
    {
        $this->rols = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->messages_destinataires = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRols(): Collection
    {
        return $this->rols;
    }

    public function addRol(Role $rol): self
    {
        if (!$this->rols->contains($rol)) {
            $this->rols[] = $rol;
            $rol->addUser($this);
        }

        return $this;
    }

    public function removeRol(Role $rol): self
    {
        if ($this->rols->contains($rol)) {
            $this->rols->removeElement($rol);
            $rol->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setProprietaireMessage($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getProprietaireMessage() === $this) {
                $message->setProprietaireMessage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messages[]
     */
    public function getMessagesDestinataires(): Collection
    {
        return $this->messages_destinataires;
    }

    public function addMessagesDestinataire(Messages $messagesDestinataire): self
    {
        if (!$this->messages_destinataires->contains($messagesDestinataire)) {
            $this->messages_destinataires[] = $messagesDestinataire;
            $messagesDestinataire->addDestinataireMessage($this);
        }

        return $this;
    }

    public function removeMessagesDestinataire(Messages $messagesDestinataire): self
    {
        if ($this->messages_destinataires->contains($messagesDestinataire)) {
            $this->messages_destinataires->removeElement($messagesDestinataire);
            $messagesDestinataire->removeDestinataireMessage($this);
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
            $image->setUser($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getUser() === $this) {
                $image->setUser(null);
            }
        }

        return $this;
    }
}
