<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movies $idMovie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSession = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Halls $halls = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMovie(): ?Movies
    {
        return $this->idMovie;
    }

    public function setIdMovie(?Movies $idMovie): self
    {
        $this->idMovie = $idMovie;

        return $this;
    }

    public function getDateSession(): ?\DateTimeInterface
    {
        return $this->dateSession;
    }

    public function setDateSession(\DateTimeInterface $dateSession): self
    {
        $this->dateSession = $dateSession;

        return $this;
    }

    public function getHalls(): ?Halls
    {
        return $this->halls;
    }

    public function setHalls(?Halls $halls): self
    {
        $this->halls = $halls;

        return $this;
    }
}
