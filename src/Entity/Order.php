<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Traits\EntityDateTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    use EntityDateTrait;

    public const STATUS_NEW = 'new';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_COMPLETED = 'completed';

    public const STATUS_OPTIONS = [
        self::STATUS_NEW,
        self::STATUS_CANCELED,
        self::STATUS_COMPLETED,
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     *
     * @Assert\NotBlank(message="Status must be selected")
     * @Assert\Choice(choices=Reservation::STATUS_OPTIONS, message="Chose valid status")
     */
    private string $status = self::STATUS_NEW;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
