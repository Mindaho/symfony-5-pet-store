<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ReservationRepository;
use App\Traits\EntityDateTrait;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
     * @ORM\Column(type="datetime")
     *
     * @Assert\DateTime()
     */
    private ?DateTimeInterface $reservationDate = null;

    /**
     * @ORM\Column(type="string", length=20)
     *
     * @Assert\NotBlank(message="Status must be selected")
     * @Assert\Choice(choices=Reservation::STATUS_OPTIONS, message="Chose valid status")
     */
    private string $status = self::STATUS_NEW;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): self
    {
        $this->reservationDate = $reservationDate;

        return $this;
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
}
