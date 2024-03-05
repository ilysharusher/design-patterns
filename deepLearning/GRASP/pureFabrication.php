<?php

// in this example, ProductRepository is a pure fabrication because it doesn't represent a real-world object

class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
}

class ProductRepository {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function save(Product $product) {
        // save product to database
    }
}

