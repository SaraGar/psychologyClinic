<?php

namespace App\Entity;

use App\Repository\PsychologistRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=PsychologistRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Psychologist implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $idCardNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $professionalRegistrationNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin = 0;

    /**
     * @ORM\Column(type="text", nullable=true)
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
     * @ORM\ManyToMany(targetEntity=Therapy::class, inversedBy="psychologists")
     */
    private $therapies;

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
        $this->appointments = new ArrayCollection();
        $this->schedules = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->worksheets = new ArrayCollection();
        $this->therapies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_PROFESSIONAL';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getIdCardNumber(): ?string
    {
        return $this->idCardNumber;
    }

    public function setIdCardNumber(string $idCardNumber): self
    {
        $this->idCardNumber = $idCardNumber;

        return $this;
    }

    public function getProfessionalRegistrationNumber(): ?string
    {
        return $this->professionalRegistrationNumber;
    }

    public function setProfessionalRegistrationNumber(string $professionalRegistrationNumber): self
    {
        $this->professionalRegistrationNumber = $professionalRegistrationNumber;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

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

    public function getDescriptionBlockSpanish(): ?string
    {
        return $this->descriptionBlockSpanish;
    }

    public function setDescriptionBlockSpanish(?string $descriptionBlockSpanish): self
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

    public function setDescriptionBlockItalian(?string $descriptionBlockItalian): self
    {
        $this->descriptionBlockItalian = $descriptionBlockItalian;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
