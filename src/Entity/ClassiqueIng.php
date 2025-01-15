<?php

namespace App\Entity;

use App\Repository\ClassiqueIngRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassiqueIngRepository::class)]
class ClassiqueIng
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $classique = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'classiqueIng')]
    private Collection $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
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
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): static
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas->add($pizza);
            $pizza->addClassiqueIng($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): static
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeClassiqueIng($this);
        }

        return $this;
    }

}
