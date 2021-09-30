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
     * @ORM\ManyToOne(targetEntity=beer::class, inversedBy="statistics")
     */
    private $Beer;

    /**
     * @ORM\ManyToOne(targetEntity=client::class, inversedBy="statistics")
     */
    private $client;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeer(): ?beer
    {
        return $this->Beer;
    }

    public function setBeer(?beer $Beer): self
    {
        $this->Beer = $Beer;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
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
}
