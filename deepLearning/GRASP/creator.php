<?php

interface IProduct
{
    public function getPrice(): int;
    public function getQuantity(): int;
}

abstract class Product implements IProduct
{
    protected string $name;
    protected int $price;
    protected int $quantity;

    protected int $discount = 0;

    public function __construct(int $price, int $quantity)
    {
        $classParts = explode('\\', static::class);
        $productName = end($classParts);

        $this->quantity = $quantity;
        $this->name = $productName;
        $this->price = $price;
    }

    public function addDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    protected function calculateDiscountedPrice(): int
    {
        return $this->discount
            ? $this->price * $this->discount / 100
            : $this->price;
    }
}

class ProductFactory
{
    public function __invoke(string $product, int $price, int $quantity): Product
    {
        if(!class_exists($product)) {
            throw new \InvalidArgumentException('Product not found');
        }

        return new $product($price, $quantity);
    }
}

class Potato extends Product
{
    public function __construct(int $price, int $quantity)
    {
        parent::__construct($price, $quantity);

        $this->quantity >= 10
            ? $this->addDiscount(20)
            : $this->addDiscount(10);
    }

    #[\Override] public function getPrice(): int
    {
        return $this->calculateDiscountedPrice();
    }

    #[\Override] public function getQuantity(): int
    {
        return $this->quantity;
    }
}

class Cucumber extends Product
{
    public function __construct(int $price, int $quantity)
    {
        parent::__construct($price, $quantity);

        $this->quantity >= 5
            ? $this->addDiscount(10)
            : $this->addDiscount(5);
    }

    #[\Override] public function getPrice(): int
    {
        return $this->calculateDiscountedPrice();
    }

    #[\Override] public function getQuantity(): int
    {
        return $this->quantity;
    }
}

class Tomato extends Product
{
    public function __construct(int $price, int $quantity)
    {
        parent::__construct($price, $quantity);

        $this->quantity >= 15
            ? $this->addDiscount(30)
            : $this->addDiscount(15);
    }

    #[\Override] public function getPrice(): int
    {
        return $this->calculateDiscountedPrice();
    }

    #[\Override] public function getQuantity(): int
    {
        return $this->quantity;
    }
}

class RowAmount
{
    protected int $amount;

    public function __construct(Product $product)
    {
        $this->amount = $product->getPrice() * $product->getQuantity();
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}

class CheckAmount
{
    protected array $rowAmounts = [];

    public function addRowAmount(RowAmount $rowAmount): void
    {
        $this->rowAmounts[] = $rowAmount;
    }

    public function removeRowAmount(RowAmount $rowAmount): void
    {
        $rowAmountKey = array_search($rowAmount, $this->rowAmounts, true);

        if ($rowAmountKey !== false) {
            unset($this->rowAmounts[$rowAmountKey]);
        }
    }

    public function getAmount(): int
    {
        $amount = 0;

        foreach ($this->rowAmounts as $rowAmount) {
            $amount += $rowAmount->getAmount();
        }

        return $amount;
    }
}

$productFactory = new ProductFactory();

$potato = $productFactory('Potato', 100, 10);
$cucumber = $productFactory('Cucumber', 50, 5);
$tomato = $productFactory('Tomato', 200, 15);

$rowAmount1 = new RowAmount($potato);
$rowAmount2 = new RowAmount($cucumber);
$rowAmount3 = new RowAmount($tomato);

$checkAmount = new CheckAmount();

$checkAmount->addRowAmount($rowAmount1);
$checkAmount->addRowAmount($rowAmount2);
$checkAmount->addRowAmount($rowAmount3);

echo $checkAmount->getAmount() . PHP_EOL;
var_dump($potato, $cucumber, $tomato);