<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 500)]
    #[Groups("comment")]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BlogPost $blog = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[Groups("comment")]
    private ?AppUser $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private ?\DateTimeInterface $createdate = null;

    public function __construct()
    {
        $this->createdate = new DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getBlog(): ?BlogPost
    {
        return $this->blog;
    }

    public function setBlog(?BlogPost $blog): static
    {
        $this->blog = $blog;

        return $this;
    }

    public function getAuthor(): ?AppUser
    {
        return $this->author;
    }

    public function setAuthor(?APpUser $author): static
    {
        $this->author = $author;

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
}
