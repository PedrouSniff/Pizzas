<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $classique = null;

    /**
     * @var Collection<int, pizza>
     */
    #[ORM\ManyToMany(targetEntity: pizza::class, inversedBy: 'ingredients')]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassique(): ?string
    {
        return $this->classique;
    }

    public function setClassique(string $classique): static
    {
        $this->classique = $classique;

        return $this;
    }

    /**
     * @return Collection<int, pizza>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(pizza $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(pizza $ingredient): static
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }
}
