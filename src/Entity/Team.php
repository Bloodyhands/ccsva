<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
    protected $category;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Staff", mappedBy="teams")
     */
    protected $staffs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Match", inversedBy="teams")
     */
    protected $matchs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Division", inversedBy="teams")
     */
    protected $divisions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Image", inversedBy="teams")
     */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calling", mappedBy="teams")
     */
    protected $callings;

    public function __construct()
    {
        $this->staffs = new ArrayCollection();
        $this->matchs = new ArrayCollection();
        $this->callings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->addTeam($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
            $staff->removeTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getMatchs(): Collection
    {
        return $this->matchs;
    }

    public function addMatch(Match $match): self
    {
        if (!$this->matchs->contains($match)) {
            $this->matchs[] = $match;
        }

        return $this;
    }

    public function removeMatch(Match $match): self
    {
        if ($this->matchs->contains($match)) {
            $this->matchs->removeElement($match);
        }

        return $this;
    }

    public function getDivisions(): ?Division
    {
        return $this->divisions;
    }

    public function setDivisions(?Division $divisions): self
    {
        $this->divisions = $divisions;

        return $this;
    }

    public function getImages(): ?Image
    {
        return $this->images;
    }

    public function setImages(?Image $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection|Calling[]
     */
    public function getCallings(): Collection
    {
        return $this->callings;
    }

    public function addCalling(Calling $calling): self
    {
        if (!$this->callings->contains($calling)) {
            $this->callings[] = $calling;
        }

        return $this;
    }

    public function removeCalling(Calling $calling): self
    {
        if ($this->callings->contains($calling)) {
            $this->callings->removeElement($calling);
        }

        return $this;
    }
}
