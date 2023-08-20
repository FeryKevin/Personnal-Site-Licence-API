<?php

namespace App\ApiResource;

use App\Repository\PeopleRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeopleRepository::class)]
#[ApiResource]
class People
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(length: 180, nullable: false)]
    private ?string $firstname = null;

    #[ORM\Column(length: 180, nullable: false)]
    private ?string $email = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'message')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname = null): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->cities->contains($message)) {
            $this->cities->add($message);
            $message->setPeople($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->cities->removeElement($message)) {
            if ($message->getPeople() === $this) {
                $message->setPeople(null);
            }
        }

        return $this;
    }
}
