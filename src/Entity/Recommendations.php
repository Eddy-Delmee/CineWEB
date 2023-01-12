<?php

namespace App\Entity;

use App\Repository\RecommendationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecommendationsRepository::class)]
class Recommendations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $forbiddenAge = null;

    #[ORM\OneToMany(mappedBy: 'idRecommendation', targetEntity: Movies::class)]
    private Collection $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForbiddenAge(): ?string
    {
        return $this->forbiddenAge;
    }

    public function setForbiddenAge(?string $forbiddenAge): self
    {
        $this->forbiddenAge = $forbiddenAge;

        return $this;
    }

    /**
     * @return Collection<int, Movies>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movies $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setIdRecommendation($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getIdRecommendation() === $this) {
                $movie->setIdRecommendation(null);
            }
        }

        return $this;
    }
}
