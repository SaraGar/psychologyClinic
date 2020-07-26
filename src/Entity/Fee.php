<?php

namespace App\Entity;

use App\Repository\FeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeeRepository::class)
 */
class Fee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discount;

    /**
     * @ORM\OneToMany(targetEntity=Therapy::class, mappedBy="fee")
     */
    private $therapies;

    public function __construct()
    {
        $this->therapies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection|Therapy[]
     */
    public function getTherapies(): Collection
    {
        return $this->therapies;
    }

    public function addTherapy(Therapy $therapy): self
    {
        if (!$this->therapies->contains($therapy)) {
            $this->therapies[] = $therapy;
            $therapy->setFee($this);
        }

        return $this;
    }

    public function removeTherapy(Therapy $therapy): self
    {
        if ($this->therapies->contains($therapy)) {
            $this->therapies->removeElement($therapy);
            // set the owning side to null (unless already changed)
            if ($therapy->getFee() === $this) {
                $therapy->setFee(null);
            }
        }

        return $this;
    }
}
