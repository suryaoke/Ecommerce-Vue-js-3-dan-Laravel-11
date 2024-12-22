<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),

        ]);
    }


    public function show(Product $product)
    {
        if (!$product) {
            abort(404);
        }

        return ProductResource::collection(
            $product->load(['colors', 'sizes', 'riviews', 'category', 'brand'])
        );
    }


    public function filterProductsByCategory(Category $category)
    {
        return ProductResource::collection(
            $category->products()->with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),
            'filter' => $category->name

        ]);
    }


    public function filterProductsByBrand(Brand $brand)
    {
        return ProductResource::collection(
            $brand->products()->with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),
            'filter' => $brand->name

        ]);
    }



    public function filterProductsByColor(Color $color)
    {
        return ProductResource::collection(
            $color->products()->with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),
            'filter' => $color->name

        ]);
    }



    public function filterProductsBySize(Size $size)
    {
        return ProductResource::collection(
            $size->products()->with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),
            'filter' => $size->name

        ]);
    }

    public function findProductsByTerm($searchTerm)
    {
        return ProductResource::collection(
            Product::where('name', 'LIKE', '%' . $searchTerm . '%')->with(['colors', 'sizes', 'category', 'brand'])->latest()->get()
        )->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
            'brands' => Brand::has('products')->get(),
            'categories' => Category::has('products')->get(),

        ]);
    }
}
