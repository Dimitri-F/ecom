<?php
namespace Class;

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

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return $this->price;
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

}