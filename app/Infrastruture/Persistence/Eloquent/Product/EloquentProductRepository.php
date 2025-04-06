<?php

namespace App\Infrastruture\Persistence\Eloquent\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Models\Products;

class EloquentProductRepository implements ProductRepository
{
    public function getAllProducts(): array
    {
        return Products::all()->toArray();
    }

    public function create(Product $product)
    {
        $ProductModel = Products::find($product->getItemcode()) ?? new Products();
        $ProductModel->Itemcode = $product->getItemcode();
        $ProductModel->Item_Name = $product->getItemName();
        $ProductModel->Description = $product->getDescription();
        $ProductModel->Unit_Price = $product->getUnitPrice();
        $ProductModel->Quantity = $product->getQuantity();
        $ProductModel->Image = $product->getImage();
        $ProductModel->save();
    }

    public function update(Product $product)
    {
        $ProductModel = Products::find($product->getItemcode());

        if ($ProductModel) {
            $ProductModel->Item_Name = $product->getItemName();
            $ProductModel->Description = $product->getDescription();
            $ProductModel->Unit_Price = $product->getUnitPrice();
            $ProductModel->Quantity = $product->getQuantity();
            $ProductModel->Image = $product->getImage();
            $ProductModel->save();
        }
    }

    public function delete(string $Itemcode)
    {
        $ProductModel = Products::find($Itemcode);

        if ($ProductModel) {
            $ProductModel->delete();
        }
    }


    public function getProductById(string $id): ?Product
    {
        $productModel = Products::find($id);

        if ($productModel) {
            return new Product(
                $productModel->Itemcode,
                $productModel->Item_Name,
                $productModel->Description,
                $productModel->Unit_Price,
                $productModel->Quantity,
                $productModel->Image
            );
        }

        return null;
    }   


}