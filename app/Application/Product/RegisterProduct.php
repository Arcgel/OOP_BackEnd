<?php

namespace App\Application\Product;
use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;

class RegisterProduct
{
    public function __construct(private ProductRepository $productRepository)
    {
        return $this->productRepository = $productRepository;
    }
    public function CreateProduct(
        string $Itemcode,
        string $Item_Name,
        string $Description,
        string $Unit_Price,
        string $Quantity,
        string $Image
    )
    {
        $product = new Product(
            $Itemcode,
            $Item_Name,
            $Description,
            $Unit_Price,
            $Quantity,
            $Image
        );

        return $this->productRepository->create($product);
    }

    public function UpdateProduct(
        string $Itemcode,
        string $Item_Name,
        string $Description,
        string $Unit_Price,
        string $Quantity,
        string $Image
    )
    {
        $product = new Product(
            $Itemcode,
            $Item_Name,
            $Description,
            $Unit_Price,
            $Quantity,
            $Image
        );

        return $this->productRepository->update($product);
    }

    public function DeleteProduct(string $Itemcode)
    {
        return $this->productRepository->delete($Itemcode);
    }

}