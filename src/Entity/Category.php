<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    const SPECIAL="special";
    const NORMAL="normal";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Beer::class, inversedBy="categories")
     */
    private $categori;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tern;

    public function __construct()
    {
        $this->categori = new ArrayCollection();
        $this->setTern(self::NORMAL);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getCategori(): Collection
    {
        return $this->categori;
    }

    public function addCategori(Beer $categori): self
    {
        if (!$this->categori->contains($categori)) {
            $this->categori[] = $categori;
        }

        return $this;
    }

    public function removeCategori(Beer $categori): self
    {
        $this->categori->removeElement($categori);

        return $this;
    }

    public function getTern(): ?string
    {
        return $this->tern;
    }

    public function setTern(string $tern): self
    {
      //  if (!empty($tern)){$tern='normal';}
      if (!in_array($tern,[self::NORMAL,self::SPECIAL])){
         throw new \InvalidArgumentException("invalid tern"); 
      }
        $this->tern = $tern;

        return $this;
    }
}
