<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: 'post')]
#[ORM\Index(name: 'idx_post_created_at', columns: ['created_at'])]
#[ORM\Index(name: 'idx_post_author_id', columns: ['author_id'])]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 10)]
    private ?string $content = null;

    #[ORM\Column(name: 'author_id')]
    private ?int $authorId = null;

    #[ORM\Column(length: 180)]
    private ?string $authorEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $authorName = null;

    #[ORM\Column(length: 30)]
    private ?string $authorRole = null;

    #[ORM\Column(name: 'is_doctor_post')]
    private bool $isDoctorPost = false;

    #[ORM\Column(name: 'allow_comments')]
    private bool $allowComments = true;

    #[ORM\Column(name: 'image_path', length: 255, nullable: true)]
    private ?string $imagePath = null;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: ForumComment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: PostLike::class, orphanRemoval: true)]
    private Collection $likes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }
    public function getContent(): ?string { return $this->content; }
    public function setContent(string $content): static { $this->content = $content; return $this; }
    public function getAuthorId(): ?int { return $this->authorId; }
    public function setAuthorId(int $authorId): static { $this->authorId = $authorId; return $this; }
    public function getAuthorEmail(): ?string { return $this->authorEmail; }
    public function setAuthorEmail(string $authorEmail): static { $this->authorEmail = $authorEmail; return $this; }
    public function getAuthorName(): ?string { return $this->authorName; }
    public function setAuthorName(string $authorName): static { $this->authorName = $authorName; return $this; }
    public function getAuthorRole(): ?string { return $this->authorRole; }
    public function setAuthorRole(string $authorRole): static { $this->authorRole = $authorRole; return $this; }
    public function isDoctorPost(): bool { return $this->isDoctorPost; }
    public function getIsDoctorPost(): bool { return $this->isDoctorPost; }
    public function setIsDoctorPost(bool $isDoctorPost): static { $this->isDoctorPost = $isDoctorPost; return $this; }
    public function allowsComments(): bool { return $this->allowComments; }
    public function getAllowComments(): bool { return $this->allowComments; }
    public function setAllowComments(bool $allowComments): static { $this->allowComments = $allowComments; return $this; }
    public function getImagePath(): ?string { return $this->imagePath; }
    public function setImagePath(?string $imagePath): static { $this->imagePath = $imagePath; return $this; }
    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    /** @return Collection<int, ForumComment> */
    public function getComments(): Collection { return $this->comments; }

    /** @return Collection<int, PostLike> */
    public function getLikes(): Collection { return $this->likes; }
}
