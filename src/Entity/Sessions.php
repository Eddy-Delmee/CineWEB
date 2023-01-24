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
    private ?Halls $idHall = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movies $idMovie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdHall(): ?Halls
    {
        return $this->idHall;
    }

    public function setIdHall(?Halls $idHall): self
    {
        $this->idHall = $idHall;

        return $this;
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
}
