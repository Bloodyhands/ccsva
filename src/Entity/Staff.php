<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StaffRepository")
 */
class Staff
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $firstname;

	/**
	 * @ORM\Column(type="date")
	 */
	protected $birthdate;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	protected $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $position;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", inversedBy="staffs")
     */
    protected $teams;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Calling", inversedBy="staffs")
     */
    protected $callings;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->callings = new ArrayCollection();
    }

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name): void
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname): void
	{
		$this->firstname = $firstname;
	}

	/**
	 * @return mixed
	 */
	public function getBirthdate()
	{
		return $this->birthdate;
	}

	/**
	 * @param mixed $birthdate
	 */
	public function setBirthdate($birthdate): void
	{
		$this->birthdate = $birthdate;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email): void
	{
		$this->email = $email;
	}

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
        }

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
