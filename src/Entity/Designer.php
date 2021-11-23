<?php

namespace App\Entity;

use App\Repository\DesignerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DesignerRepository::class)
 */
class Designer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
<<<<<<< HEAD
=======
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
>>>>>>> b29129fec2eb1b2fe4c98912b5d9c2ec6c3e5eb1
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="designer", orphanRemoval=true)
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

<<<<<<< HEAD
    public function __toString()
    {
        return $this->getName();
    }

=======
>>>>>>> b29129fec2eb1b2fe4c98912b5d9c2ec6c3e5eb1
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

<<<<<<< HEAD
=======
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

>>>>>>> b29129fec2eb1b2fe4c98912b5d9c2ec6c3e5eb1
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setDesigner($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDesigner() === $this) {
                $product->setDesigner(null);
            }
        }

        return $this;
    }
}
