<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 */
class Group
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
    private $groupNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupNumber(): ?string
    {
        return $this->groupNumber;
    }

    public function setGroupNumber(string $groupNumber): self
    {
        $this->groupNumber = $groupNumber;

        return $this;
    }
}
