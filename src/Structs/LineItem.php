<?php

namespace Montonio\Structs;

class LineItem extends AbstractStruct
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var float
     */
    protected $quantity = 1;
    /**
     * @var float
     */
    protected $finalPrice;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return LineItem
     */
    public function setName(string $name): LineItem
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return LineItem
     */
    public function setQuantity($quantity): LineItem
    {
        $this->quantity = (float)$quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): ?float
    {
        return $this->finalPrice;
    }

    /**
     * @param float $finalPrice
     * @return LineItem
     */
    public function setFinalPrice($finalPrice): LineItem
    {
        $this->finalPrice = (float)$finalPrice;
        return $this;
    }


}