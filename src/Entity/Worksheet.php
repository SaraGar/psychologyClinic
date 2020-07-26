<?php

namespace App\Entity;

use App\Repository\WorksheetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorksheetRepository::class)
 */
class Worksheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="worksheets")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Psychologist::class, inversedBy="worksheets")
     */
    private $psychologist;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $symptoms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anxietyLevel;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAlertNeeded;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPsychologist(): ?Psychologist
    {
        return $this->psychologist;
    }

    public function setPsychologist(?Psychologist $psychologist): self
    {
        $this->psychologist = $psychologist;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSymptoms(): ?string
    {
        return $this->symptoms;
    }

    public function setSymptoms(?string $symptoms): self
    {
        $this->symptoms = $symptoms;

        return $this;
    }

    public function getAnxietyLevel(): ?int
    {
        return $this->anxietyLevel;
    }

    public function setAnxietyLevel(?int $anxietyLevel): self
    {
        $this->anxietyLevel = $anxietyLevel;

        return $this;
    }

    public function getIsAlertNeeded(): ?bool
    {
        return $this->isAlertNeeded;
    }

    public function setIsAlertNeeded(bool $isAlertNeeded): self
    {
        $this->isAlertNeeded = $isAlertNeeded;

        return $this;
    }
}
