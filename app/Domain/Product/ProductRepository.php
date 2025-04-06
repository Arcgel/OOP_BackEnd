<?php

namespace App\Domain\Product;

interface ProductRepository
{
    public function getAllProducts(): array;
    public function getProductById(string $id): ?Product;
    public function create(Product $product);
    public function update(Product $product);
    public function delete(string $id);
}