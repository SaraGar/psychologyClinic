<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="clients")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="client")
     */
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity=Report::class, mappedBy="client")
     */
    private $reports;

    /**
     * @ORM\OneToMany(targetEntity=Worksheet::class, mappedBy="client")
     */
    private $worksheets;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->worksheets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setClient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getClient() === $this) {
                $appointment->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setClient($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getClient() === $this) {
                $report->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Worksheet[]
     */
    public function getWorksheets(): Collection
    {
        return $this->worksheets;
    }

    public function addWorksheet(Worksheet $worksheet): self
    {
        if (!$this->worksheets->contains($worksheet)) {
            $this->worksheets[] = $worksheet;
            $worksheet->setClient($this);
        }

        return $this;
    }

    public function removeWorksheet(Worksheet $worksheet): self
    {
        if ($this->worksheets->contains($worksheet)) {
            $this->worksheets->removeElement($worksheet);
            // set the owning side to null (unless already changed)
            if ($worksheet->getClient() === $this) {
                $worksheet->setClient(null);
            }
        }

        return $this;
    }
}
