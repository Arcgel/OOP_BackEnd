<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ArchiveProducts;
use App\Application\Product\RegisterProduct;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct(private RegisterProduct $registerProduct)
    {
        return $this->registerProduct = $registerProduct;
    }

    public function GetAllProducts()
    {
        $products = Products::all();

        return Response()->json([
            'status' => 200,
            'message' => 'Products Retrieved Successfully',
            'data' => $products
        ]);
    }

    public function CreateProduct(Request $request)
    {
        $ValidateFields = array_map('trim', $request->all());

        // Validate the request data
        $validator = Validator::make($ValidateFields, [
            'Itemcode' => 'required|string|max:255',
            'Item_Name' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Unit_Price' => 'required|numeric',
            'Quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        Validator::make($request->all(), [
            'Itemcode' => 'required|string|max:255',
            'Item_Name' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Unit_Price' => 'required|numeric',
            'Quantity' => 'required|integer',
            'Image' => 'required|image', // image validation
        ]);

        // Check if the product already exists
        if(Products::where('Itemcode', $request->Itemcode)->exists()) {
            // return redirect()->back()->with('error', 'Product Already Exists');
            return response()->json([
                'status' => 409,
                'message' => 'Product Already Exists'
            ], 409);
        }

        // Check if the request has a file
        $data = [];

        // Validate the request data
        if($request->hasFile('Image')) {
            $file = $request->file('Image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['Image'] = $filename;
        }

        $Itemcode = $this->GetTheGenerateProductId();
 
        // Create a new product instance
        $product = $this->registerProduct->CreateProduct(
            $request->Itemcode,
            $request->Item_Name,
            $request->Description,
            $request->Unit_Price,
            $request->Quantity,
            $request->Image,
        );

        // Save the product to the database
        return Response()->json([
            'status' => 200,
            'message' => 'Product Created Successfully',
            'data' => $product
        ]);

        // return redirect()->back()->with('success', 'Product Created Successfully');
    }

    public function GetTheGenerateProductId(): string
    {
        do {
            $id = $this->GenerateProductId(6);
            // Check if the generated ID already exists
            $exists = Products::where('Itemcode', $id)->first();
        } while ($exists !== null); // Ensure the ID is unique

        return $id;
    }

    public function GenerateProductId(int $length = 0): string
    {
        // Generate a random string of the specified length
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);
        return $result;
    }

    public function UpdateProduct(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'Itemcode' => 'required|string|max:255',
            'Item_Name' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Unit_Price' => 'required|numeric',
            'Quantity' => 'required|integer',
            'Image' => 'required|nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the product by ID
        $product = Products::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }

        // Update the product fields
        $product->Itemcode = $request->Itemcode;
        $product->Item_Name = $request->Item_Name;
        $product->Description = $request->Description;
        $product->Unit_Price = $request->Unit_Price;
        $product->Quantity = $request->Quantity;

        // Check if the request has a file
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $product->Image = $filename;
        }

        // Save the updated product to the database
        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'Product Updated Successfully',
            'data' => $product
        ]);
    }
    public function DeleteProduct($id)
    {
        // Find the product by ID
        $product = Products::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }

        // Delete the product from the database
        $product->delete();

        ArchiveProducts::create([
            'Itemcode' => $product->Itemcode,
            'Item_Name' => $product->Item_Name,
            'Description' => $product->Description,
            'Unit_Price' => $product->Unit_Price,
            'Quantity' => $product->Quantity,
            'Image' => $product->Image,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product Deleted Successfully'
        ]);
    }

    public function RestoreProduct($id)
    {
        // Find the product by ID
        $product = ArchiveProducts::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }

        // Delete the product from the database
        $product->delete();

        Products::create([
            'Itemcode' => $product->Itemcode,
            'Item_Name' => $product->Item_Name,
            'Description' => $product->Description,
            'Unit_Price' => $product->Unit_Price,
            'Quantity' => $product->Quantity,
            'Image' => $product->Image,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Product Restore Successfully'
        ]);
    }


    public function GetProductById($id)
    {
        // Find the product by ID
        $product = Products::find($id);

        if (!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Product Retrieved Successfully',
            'data' => $product
        ]);
    }
  
}
