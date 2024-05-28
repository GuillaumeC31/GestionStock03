<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Categorie = null;

    /**
     * @var Collection<int, Products>
     */
    #[ORM\OneToMany(targetEntity: Products::class, mappedBy: 'Category')]
    private Collection $Category;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Products $category): static
    {
        if (!$this->Category->contains($category)) {
            $this->Category->add($category);
            $category->setCategory($this);
        }

        return $this;
    }

    public function removeCategory(Products $category): static
    {
        if ($this->Category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory() === $this) {
                $category->setCategory(null);
            }
        }

        return $this;
    }

}
