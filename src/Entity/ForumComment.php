<?php

namespace App\Entity;

use App\Repository\ForumCommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ForumCommentRepository::class)]
#[ORM\Table(name: 'forum_comment')]
#[ORM\Index(name: 'idx_forum_comment_post_id', columns: ['post_id'])]
#[ORM\Index(name: 'idx_forum_comment_parent_id', columns: ['parent_comment_id'])]
class ForumComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Post $post = null;

    #[ORM\Column(name: 'author_id')]
    private ?int $authorId = null;

    #[ORM\Column(length: 180)]
    private ?string $authorEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $authorName = null;

    #[ORM\Column(length: 30)]
    private ?string $authorRole = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'replies')]
    #[ORM\JoinColumn(name: 'parent_comment_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?self $parentComment = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 5000)]
    private ?string $content = null;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'parentComment', targetEntity: self::class, orphanRemoval: true)]
    #[ORM\OrderBy(['createdAt' => 'ASC'])]
    private Collection $replies;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->replies = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getPost(): ?Post { return $this->post; }
    public function setPost(?Post $post): static { $this->post = $post; return $this; }
    public function getAuthorId(): ?int { return $this->authorId; }
    public function setAuthorId(int $authorId): static { $this->authorId = $authorId; return $this; }
    public function getAuthorEmail(): ?string { return $this->authorEmail; }
    public function setAuthorEmail(string $authorEmail): static { $this->authorEmail = $authorEmail; return $this; }
    public function getAuthorName(): ?string { return $this->authorName; }
    public function setAuthorName(string $authorName): static { $this->authorName = $authorName; return $this; }
    public function getAuthorRole(): ?string { return $this->authorRole; }
    public function setAuthorRole(string $authorRole): static { $this->authorRole = $authorRole; return $this; }
    public function getParentComment(): ?self { return $this->parentComment; }
    public function setParentComment(?self $parentComment): static { $this->parentComment = $parentComment; return $this; }
    public function getContent(): ?string { return $this->content; }
    public function setContent(string $content): static { $this->content = $content; return $this; }
    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    /** @return Collection<int, self> */
    public function getReplies(): Collection { return $this->replies; }
}
