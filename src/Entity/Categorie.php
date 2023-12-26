<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Tache::class, orphanRemoval: true)]
    private Collection $taches;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTaches(Tache $taches): static
    {
        if (!$this->taches->contains($taches)) {
            $this->taches->add($taches);
            $taches->setCategorie($this);
        }

        return $this;
    }

    public function removeTaches(Tache $taches): static
    {
        if ($this->taches->removeElement($taches)) {
            // set the owning side to null (unless already changed)
            if ($taches->getCategorie() === $this) {
                $taches->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->titre;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
