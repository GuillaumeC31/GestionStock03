<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
class Manufacturer
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Fabricant = null;

    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->Fabricant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFabricant(): ?string
    {
        return $this->Fabricant;
    }

    public function setFabricant(string $Fabricant): static
    {
        $this->Fabricant = $Fabricant;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

}
