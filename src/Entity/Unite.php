<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UniteRepository")
 */
class Unite
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
    private $symbole;

    /**
     * @ORM\Column(type="text")
     */
    private $definition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(string $symbole): self
    {
        $this->symbole = $symbole;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    public function getSourceId(): ?Source
    {
        return $this->source_id;
    }

    public function setSourceId(?Source $source_id): self
    {
        $this->source_id = $source_id;

        return $this;
    }
}
