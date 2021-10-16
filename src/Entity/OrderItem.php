<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderItemRepository;
use App\Traits\EntityDateTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    use EntityDateTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private Product $product;

    /**
     * @OneToOne(targetEntity="Order")
     * @JoinColumn(name="order_id", referencedColumnName="id")
     */
    private Order $order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
