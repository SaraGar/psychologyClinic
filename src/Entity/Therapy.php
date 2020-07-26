<?php

namespace App\Entity;

use App\Repository\TherapyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TherapyRepository::class)
 */
class Therapy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Fee::class, inversedBy="therapies")
     */
    private $fee;

    /**
     * @ORM\ManyToMany(targetEntity=Psychologist::class, mappedBy="therapies")
     */
    private $psychologists;

    public function __construct()
    {
        $this->psychologists = new ArrayCollection();
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

    public function getFee(): ?Fee
    {
        return $this->fee;
    }

    public function setFee(?Fee $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return Collection|Psychologist[]
     */
    public function getPsychologists(): Collection
    {
        return $this->psychologists;
    }

    public function addPsychologist(Psychologist $psychologist): self
    {
        if (!$this->psychologists->contains($psychologist)) {
            $this->psychologists[] = $psychologist;
            $psychologist->addTherapy($this);
        }

        return $this;
    }

    public function removePsychologist(Psychologist $psychologist): self
    {
        if ($this->psychologists->contains($psychologist)) {
            $this->psychologists->removeElement($psychologist);
            $psychologist->removeTherapy($this);
        }

        return $this;
    }
}
