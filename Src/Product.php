<?php
namespace Src;

class Product
{
    private int $id;
    private string $title;
    private float $price;

    public function __construct($id, $title, $price) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

}