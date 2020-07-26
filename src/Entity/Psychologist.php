<?php

namespace App\Entity;

use App\Repository\PsychologistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PsychologistRepository::class)
 */
class Psychologist
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionBlockSpanish;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionBlockEnglish;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionBlockItalian;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\ManyToMany(targetEntity=Therapy::class, inversedBy="psychologists")
     */
    private $therapies;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="psychologists")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="psychologist")
     */
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity=Schedule::class, mappedBy="psychologist")
     */
    private $schedules;

    /**
     * @ORM\OneToMany(targetEntity=Report::class, mappedBy="psychologist")
     */
    private $reports;

    /**
     * @ORM\OneToMany(targetEntity=Worksheet::class, mappedBy="psychologist")
     */
    private $worksheets;

    public function __construct()
    {
        $this->therapies = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->schedules = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->worksheets = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescriptionBlockSpanish(): ?string
    {
        return $this->descriptionBlockSpanish;
    }

    public function setDescriptionBlockSpanish(string $descriptionBlockSpanish): self
    {
        $this->descriptionBlockSpanish = $descriptionBlockSpanish;

        return $this;
    }

    public function getDescriptionBlockEnglish(): ?string
    {
        return $this->descriptionBlockEnglish;
    }

    public function setDescriptionBlockEnglish(?string $descriptionBlockEnglish): self
    {
        $this->descriptionBlockEnglish = $descriptionBlockEnglish;

        return $this;
    }

    public function getDescriptionBlockItalian(): ?string
    {
        return $this->descriptionBlockItalian;
    }

    public function setDescriptionBlockItalian(string $descriptionBlockItalian): self
    {
        $this->descriptionBlockItalian = $descriptionBlockItalian;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

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
        }

        return $this;
    }

    public function removeTherapy(Therapy $therapy): self
    {
        if ($this->therapies->contains($therapy)) {
            $this->therapies->removeElement($therapy);
        }

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
            $appointment->setPsychologist($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->contains($appointment)) {
            $this->appointments->removeElement($appointment);
            // set the owning side to null (unless already changed)
            if ($appointment->getPsychologist() === $this) {
                $appointment->setPsychologist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setPsychologist($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getPsychologist() === $this) {
                $schedule->setPsychologist(null);
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
            $report->setPsychologist($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getPsychologist() === $this) {
                $report->setPsychologist(null);
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
            $worksheet->setPsychologist($this);
        }

        return $this;
    }

    public function removeWorksheet(Worksheet $worksheet): self
    {
        if ($this->worksheets->contains($worksheet)) {
            $this->worksheets->removeElement($worksheet);
            // set the owning side to null (unless already changed)
            if ($worksheet->getPsychologist() === $this) {
                $worksheet->setPsychologist(null);
            }
        }

        return $this;
    }
}
