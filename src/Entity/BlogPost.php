<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use App\Entity\AppUser;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'POST_VIEW';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("blogpost")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 225, minMessage: 'Title is too short, 5 characters is the minimum.')]
    #[Groups("blogpost")]
    private ?string $BlogTitle = null;

    #[ORM\Column(length: 5025)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 5025)]
    #[Groups("blogpost")]
    private ?string $BlogText = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    #[Groups("blogpost")]
    private ?\DateTimeInterface $createdate = null;

    #[ORM\OneToMany(mappedBy: 'blog', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\ManyToMany(targetEntity: AppUser::class, inversedBy: 'Liked')]
    #[Groups("blogpost")]
    private Collection $likedBy;

    #[ORM\ManyToOne(inversedBy: 'Blog', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AppUser $author = null;

    #[ORM\Column]
    private ?bool $extraPrivacy = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("blogpost")]
    private ?string $blogImage = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
        $this->createdate = new DateTime;
        $this->extraPrivacy = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogTitle(): ?string
    {
        return $this->BlogTitle;
    }

    public function setBlogTitle(string $BlogTitle): static
    {
        $this->BlogTitle = $BlogTitle;

        return $this;
    }

    public function getBlogText(): ?string
    {
        return $this->BlogText;
    }

    public function setBlogText(string $BlogText): static
    {
        $this->BlogText = $BlogText;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setCreatedate(\DateTimeInterface $createdate): static
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getBlogImage(): ?string
    {
        return $this->blogImage;
    }

    public function setBlogImage(?string $blogImage): static
    {
        $this->blogImage = $blogImage;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setBlog($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBlog() === $this) {
                $comment->setBlog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    public function addLikedBy(AppUser $likedBy): static
    {
        if (!$this->likedBy->contains($likedBy)) {
            $this->likedBy->add($likedBy);
        }

        return $this;
    }

    public function removeLikedBy(AppUser $likedBy): static
    {
        $this->likedBy->removeElement($likedBy);

        return $this;
    }

    public function getAuthor(): ?AppUser
    {
        return $this->author;
    }

    public function setAuthor(?AppUser $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function isExtraPrivacy(): ?bool
    {
        return $this->extraPrivacy;
    }

    public function setExtraPrivacy(bool $extraPrivacy): static
    {
        $this->extraPrivacy = $extraPrivacy;

        return $this;
    }
}
