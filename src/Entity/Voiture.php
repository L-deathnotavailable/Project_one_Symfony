<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $prixQuotidien = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\GreaterThan(value: 5,)]
    private ?float $prixMensuel = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 9)]
    private ?string $places = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $manuelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixQuotidien(): ?float
    {
        return $this->prixQuotidien;
    }

    public function setPrixQuotidien(float $prixQuotidien): static
    {
        $this->prixQuotidien = $prixQuotidien;

        return $this;
    }

    public function getPrixMensuel(): ?string
    {
        return $this->prixMensuel;
    }

    public function setPrixMensuel(string $prixMensuel): static
    {
        $this->prixMensuel = $prixMensuel;

        return $this;
    }

    public function getPlaces(): ?string
    {
        return $this->places;
    }

    public function setPlaces(string $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function isManuelle(): ?bool
    {
        return $this->manuelle;
    }

    public function setManuelle(bool $manuelle): static
    {
        $this->manuelle = $manuelle;

        return $this;
    }
}
