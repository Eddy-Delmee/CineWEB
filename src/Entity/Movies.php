<?php

namespace App\Entity;

use App\Repository\MoviesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviesRepository::class)]
class Movies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titleMovie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $director = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $producer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $actors = null;

    #[ORM\Column(length: 255)]
    private ?string $timeMovie = null;

    #[ORM\Column(length: 255)]
    private ?string $yearMovie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageMovie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $videoMovie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionMovie = null;

    #[ORM\OneToMany(mappedBy: 'idMovie', targetEntity: Sessions::class)]
    private Collection $sessions;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $idCategory = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    private ?Recommendations $idRecommendation = null;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleMovie(): ?string
    {
        return $this->titleMovie;
    }

    public function setTitleMovie(string $titleMovie): self
    {
        $this->titleMovie = $titleMovie;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(?string $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    public function getActors(): ?string
    {
        return $this->actors;
    }

    public function setActors(?string $actors): self
    {
        $this->actors = $actors;

        return $this;
    }

    public function getTimeMovie(): ?string
    {
        return $this->timeMovie;
    }

    public function setTimeMovie(string $timeMovie): self
    {
        $this->timeMovie = $timeMovie;

        return $this;
    }

    public function getYearMovie(): ?string
    {
        return $this->yearMovie;
    }

    public function setYearMovie(string $yearMovie): self
    {
        $this->yearMovie = $yearMovie;

        return $this;
    }

    public function getImageMovie(): ?string
    {
        return $this->imageMovie;
    }

    public function setImageMovie(?string $imageMovie): self
    {
        $this->imageMovie = $imageMovie;

        return $this;
    }

    public function getVideoMovie(): ?string
    {
        return $this->videoMovie;
    }

    public function setVideoMovie(?string $videoMovie): self
    {
        $this->videoMovie = $videoMovie;

        return $this;
    }

    public function getDescriptionMovie(): ?string
    {
        return $this->descriptionMovie;
    }

    public function setDescriptionMovie(?string $descriptionMovie): self
    {
        $this->descriptionMovie = $descriptionMovie;

        return $this;
    }

    /**
     * @return Collection<int, Sessions>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Sessions $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setIdMovie($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getIdMovie() === $this) {
                $session->setIdMovie(null);
            }
        }

        return $this;
    }

    public function getIdCategory(): ?Categories
    {
        return $this->idCategory;
    }

    public function setIdCategory(?Categories $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function getIdRecommendation(): ?Recommendations
    {
        return $this->idRecommendation;
    }

    public function setIdRecommendation(?Recommendations $idRecommendation): self
    {
        $this->idRecommendation = $idRecommendation;

        return $this;
    }
}
