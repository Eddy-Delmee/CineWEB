<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $monthMovie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hourMovie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dayMovie = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Halls $idHall = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movies $idMovie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonthMovie(): ?string
    {
        return $this->monthMovie;
    }

    public function setMonthMovie(?string $monthMovie): self
    {
        $this->monthMovie = $monthMovie;

        return $this;
    }

    public function getHourMovie(): ?string
    {
        return $this->hourMovie;
    }

    public function setHourMovie(?string $hourMovie): self
    {
        $this->hourMovie = $hourMovie;

        return $this;
    }

    public function getDayMovie(): ?string
    {
        return $this->dayMovie;
    }

    public function setDayMovie(?string $dayMovie): self
    {
        $this->dayMovie = $dayMovie;

        return $this;
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
}
