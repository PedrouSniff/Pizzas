<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
#[Vich\Uploadable]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'pates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pates $pates = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, classiqueIng>
     */
    #[ORM\ManyToMany(targetEntity: ClassiqueIng::class, inversedBy: 'pizzas')]
    private Collection $classiqueIng;

    public function __construct()
    {
        $this->classiqueIng = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->ingredient;
    }

    public function setIngredient(string $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getPates(): ?Pates
    {
        return $this->pates;
    }

    public function setPates(?Pates $pates): static
    {
        $this->pates = $pates;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // Si un fichier est chargé, met à jour la date
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection<int, classiqueIng>
     */
    public function getClassiqueIng(): Collection
    {
        return $this->classiqueIng;
    }

    public function addClassiqueIng(classiqueIng $classiqueIng): static
    {
        if (!$this->classiqueIng->contains($classiqueIng)) {
            $this->classiqueIng->add($classiqueIng);
        }

        return $this;
    }

    public function removeClassiqueIng(classiqueIng $classiqueIng): static
    {
        $this->classiqueIng->removeElement($classiqueIng);

        return $this;
    }
}
