<?php

namespace App\Domain\Product;

class Product
{
    public function __construct(
        private string $Itemcode,
        private string $Item_Name,
        private string $Description,
        private string $Unit_Price,
        private string $Quantity,
        private string $Image
    )
    {
        $this->Itemcode = $Itemcode;
        $this->Item_Name = $Item_Name;
        $this->Description = $Description;
        $this->Unit_Price = $Unit_Price;
        $this->Quantity = $Quantity;
        $this->Image = $Image;
    }
    public function getItemcode()
    {
        return $this->Itemcode;
    }
    public function getItemName()
    {
        return $this->Item_Name;
    }
    public function getDescription()
    {
        return $this->Description;
    }
    public function getUnitPrice()
    {
        return $this->Unit_Price;
    }
    public function getQuantity()
    {
        return $this->Quantity;
    }
    public function getImage()
    {
        return $this->Image;
    }
    
}