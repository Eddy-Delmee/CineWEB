<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titleNew = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageNew = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoNew = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionNew = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleNew(): ?string
    {
        return $this->titleNew;
    }

    public function setTitleNew(string $titleNew): self
    {
        $this->titleNew = $titleNew;

        return $this;
    }

    public function getImageNew(): ?string
    {
        return $this->imageNew;
    }

    public function setImageNew(?string $imageNew): self
    {
        $this->imageNew = $imageNew;

        return $this;
    }

    public function getVideoNew(): ?string
    {
        return $this->videoNew;
    }

    public function setVideoNew(?string $videoNew): self
    {
        $this->videoNew = $videoNew;

        return $this;
    }

    public function getDescriptionNew(): ?string
    {
        return $this->descriptionNew;
    }

    public function setDescriptionNew(?string $descriptionNew): self
    {
        $this->descriptionNew = $descriptionNew;

        return $this;
    }
}
