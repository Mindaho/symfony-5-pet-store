<?php

declare(strict_types=1);

namespace App\Traits;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait EntityDateTrait
{
    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\DateTime()
     */
    private DateTimeInterface $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\DateTime()
     */
    private ?DateTimeInterface $dateUpdated = null;

    public function __construct(){
        $this->dateCreated = new DateTime('now');
    }

    public function getDateCreated(): ?DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}