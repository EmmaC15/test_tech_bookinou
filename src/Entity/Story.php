<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

// ajout de cette ligne 
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['story:read']], // ajout de cette ligne 
)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('story:read')] // ajout de cette ligne
    private ?string $title = null;

    #[ORM\Column(length: 13)]
    private ?string $ean = null;

    /**
     * @var Collection<int, Recording>
     */
    #[ORM\OneToMany(targetEntity: Recording::class, mappedBy: 'story')]
    #[Groups('story:read')] // ajout de cette ligne
    private Collection $recordings;

    public function __construct()
    {
        $this->recordings = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(string $ean): static
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * @return Collection<int, Recording>
     */
    public function getRecordings(): Collection
    {
        return $this->recordings;
    }

    public function addRecording(Recording $recording): static
    {
        if (!$this->recordings->contains($recording)) {
            $this->recordings->add($recording);
            $recording->setStory($this);
        }

        return $this;
    }

    public function removeRecording(Recording $recording): static
    {
        if ($this->recordings->removeElement($recording)) {
            // set the owning side to null (unless already changed)
            if ($recording->getStory() === $this) {
                $recording->setStory(null);
            }
        }

        return $this;
    }
}
