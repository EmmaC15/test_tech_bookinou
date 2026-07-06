<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecordingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\State\RecordingProcessor;

use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: RecordingRepository::class)]
#[ApiResource(
    operations: [
        new Post(processor: RecordingProcessor::class),
        new Get(),
        new GetCollection(),
        new Patch(),
        new Delete(),
    ]
)]
class Recording
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('story:read')] 
    private ?string $audioKey = null;

    #[ORM\Column]
    #[Groups('story:read')] 
    private ?\DateTime $createdAt = null;

    #[ORM\Column(length: 255)]
    #[Groups('story:read')] 
    private ?string $narrator = null;

    #[ORM\ManyToOne(inversedBy: 'recordings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Story $story = null;

    public function getId(): ?Uuid
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
