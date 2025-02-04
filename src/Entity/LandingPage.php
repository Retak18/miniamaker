<?php

namespace App\Entity;

use App\Repository\LandingPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LandingPageRepository::class)]
class LandingPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'landingPages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?detail $detail_id = null;

    #[ORM\Column(length: 80)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, tag>
     */
    #[ORM\ManyToMany(targetEntity: tag::class, inversedBy: 'landingPages')]
    private Collection $tags;

    #[ORM\OneToOne(mappedBy: 'landing_page', cascade: ['persist', 'remove'])]
    private ?LpContent $lpContent = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }
    #[ORM\PreUpdate]
    public function setUpdatedAtValue()
    {
        $this->created_at = new \DateTimeImmutable();
        
    }
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetailId(): ?detail
    {
        return $this->detail_id;
    }

    public function setDetailId(?detail $detail_id): static
    {
        $this->detail_id = $detail_id;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getLpContent(): ?LpContent
    {
        return $this->lpContent;
    }

    public function setLpContent(LpContent $lpContent): static
    {
        // set the owning side of the relation if necessary
        if ($lpContent->getLandingPage() !== $this) {
            $lpContent->setLandingPage($this);
        }

        $this->lpContent = $lpContent;

        return $this;
    }
}
