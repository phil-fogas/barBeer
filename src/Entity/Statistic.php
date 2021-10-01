<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Beer::class, inversedBy="statistics")
     */
    private $Beer;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="statistics")
     */
    private $client;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $score;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_beers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeer(): ?Beer
    {
        return $this->Beer;
    }

    public function setBeer(?Beer $beer): self
    {
        $this->Beer = $beer;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getTotalBeers(): ?int
    {
        return $this->total_beers;
    }

    public function setTotalBeers(int $total_beers): self
    {
        $this->total_beers = $total_beers;

        return $this;
    }
}
