<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Traits\EntityDateTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    use EntityDateTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=30)
     *
     * @Assert\NotBlank(message="Name cannot be blank")
     * @Assert\Length(
     *     min=3,
     *     max=60,
     *     minMessage="Name length must be at least {{ limit }} characters long",
     *     maxMessage="Name length must not go above {{ limit }} characters",
     *     )
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please provide image address")
     * @Assert\Length(
     *     min=20,
     *     max=255,
     *     minMessage="Name length must be at least {{ limit }} characters long",
     *     maxMessage="Name length must not go above {{ limit }} characters",
     *     )
     */
    private string $image;

    private int $price;

    /**
     * @OneToOne(targetEntity="Stock")
     * @JoinColumn(name="stock_id", referencedColumnName="id")
     */
    private Stock $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
