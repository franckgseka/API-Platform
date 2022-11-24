<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column]
    private int $duration;

    #[ORM\Column]
    private int $productionYear;

    #[ORM\Column(type: Types::TEXT)]
    private string $synopsis;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Genre $genre;

    #[ORM\ManyToMany(targetEntity: Person::class)]
    #[ORM\JoinTable(name: 'movie_actors')]
    private Collection $actors;

    #[ORM\ManyToMany(targetEntity: Person::class)]
    #[ORM\JoinTable(name: 'movie_directors')]
    private Collection $directors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    public function setProductionYear(int $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getDirectors(): Collection
    {
        return $this->directors;
    }
}
