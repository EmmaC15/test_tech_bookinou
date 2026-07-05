<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecordingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

// ajouts des 3 lignes 
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\State\RecordingProcessor;

#[ORM\Entity(repositoryClass: RecordingRepository::class)]
//#[ApiResource] -> ajout : 
#[ApiResource(
    operations: [
        new Post(processor: RecordingProcessor::class),
        new Get(),
    ]
)]
class Recording
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $audioKey = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $narrator = null;

    #[ORM\ManyToOne(inversedBy: 'recordings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Story $story = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAudioKey(): ?string
    {
        return $this->audioKey;
    }

    public function setAudioKey(string $audioKey): static
    {
        $this->audioKey = $audioKey;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNarrator(): ?string
    {
        return $this->narrator;
    }

    public function setNarrator(string $narrator): static
    {
        $this->narrator = $narrator;

        return $this;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): static
    {
        $this->story = $story;

        return $this;
    }
}
