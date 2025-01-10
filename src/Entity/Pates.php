<?php

namespace App\Entity;

use App\Repository\PatesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatesRepository::class)]
class Pates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $types = null;

    /**
     * @var Collection<int, pizza>
     */
    #[ORM\OneToMany(targetEntity: pizza::class, mappedBy: 'pates')]
    private Collection $pates;

    public function __construct()
    {
        $this->pates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypes(): ?string
    {
        return $this->types;
    }

    public function setTypes(string $types): static
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection<int, pizza>
     */
    public function getPates(): Collection
    {
        return $this->pates;
    }

    public function addPate(pizza $pate): static
    {
        if (!$this->pates->contains($pate)) {
            $this->pates->add($pate);
            $pate->setPates($this);
        }

        return $this;
    }

    public function removePate(pizza $pate): static
    {
        if ($this->pates->removeElement($pate)) {
            // set the owning side to null (unless already changed)
            if ($pate->getPates() === $this) {
                $pate->setPates(null);
            }
        }

        return $this;
    }
}
