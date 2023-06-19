<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['quote:read'])]
    private ?string $content = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['quote:read'])]
    private ?string $author = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'quotes')]
    private Collection $savedBy;


    public function __construct()
    {
        $this->savedBy = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSavedBy(): Collection
    {
        return $this->savedBy;
    }

    public function addSavedBy(User $savedBy): static
    {
        if (!$this->savedBy->contains($savedBy)) {
            $this->savedBy->add($savedBy);
        }

        return $this;
    }

    public function removeSavedBy(User $savedBy): static
    {
        $this->savedBy->removeElement($savedBy);

        return $this;
    }



}
