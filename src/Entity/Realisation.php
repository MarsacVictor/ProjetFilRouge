<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $achetable = null;

    #[ORM\Column]
    private ?bool $vendu = null;

    #[ORM\OneToOne(mappedBy: 'realisation', cascade: ['persist', 'remove'])]
    private ?Acheteur $acheteur = null;

    #[ORM\Column(length: 255)]
    private ?string $imageRealisation = null;


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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isAchetable(): ?bool
    {
        return $this->achetable;
    }

    public function setAchetable(bool $achetable): static
    {
        $this->achetable = $achetable;

        return $this;
    }

    public function isVendu(): ?bool
    {
        return $this->vendu;
    }

    public function setVendu(bool $vendu): static
    {
        $this->vendu = $vendu;

        return $this;
    }

    public function getAcheteur(): ?Acheteur
    {
        return $this->acheteur;
    }

    public function setAcheteur(Acheteur $acheteur): static
    {
        // set the owning side of the relation if necessary
        if ($acheteur->getRealisation() !== $this) {
            $acheteur->setRealisation($this);
        }

        $this->acheteur = $acheteur;

        return $this;
    }

    public function getImageRealisation(): ?string
    {
        return $this->imageRealisation;
    }

    public function setImageRealisation(string $imageRealisation): static
    {
        $this->imageRealisation = $imageRealisation;

        return $this;
    }



}
