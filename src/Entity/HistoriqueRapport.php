<?php

namespace App\Entity;

use App\Repository\HistoriqueRapportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: HistoriqueRapportRepository::class)]
#[Broadcast]
class HistoriqueRapport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $historique_lienPdf = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $historique_datedecreation = null;

    
    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(name: "utilisateur_id", referencedColumnName: "id", nullable: false)]
    private ?int $Utilisateur_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistoriqueLienPdf(): ?string
    {
        return $this->historique_lienPdf;
    }

    public function setHistoriqueLienPdf(string $historique_lienPdf): static
    {
        $this->historique_lienPdf = $historique_lienPdf;

        return $this;
    }

    public function getHistoriqueDatedecreation(): ?\DateTimeInterface
    {
        return $this->historique_datedecreation;
    }

    public function setHistoriqueDatedecreation(\DateTimeInterface $historique_datedecreation): static
    {
        $this->historique_datedecreation = $historique_datedecreation;

        return $this;
    }

    public function getUtilisateurId(): ?int
    {
        return $this->Utilisateur_id;
    }

    public function setUtilisateurId(int $Utilisateur_id): static
    {
        $this->Utilisateur_id = $Utilisateur_id;

        return $this;
    }
}
