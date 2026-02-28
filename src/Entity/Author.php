<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de l'auteur est obligatoire")]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    #[Assert\Email(message: "L'email doit être valide")]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
