<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StockRepository;
use App\Traits\EntityDateTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    use EntityDateTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    private int $quantity = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

}
