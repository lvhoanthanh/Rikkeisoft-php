<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 20);
        $page = $request->query('page', 1);
        $keyword = $request->query('keyword', '');
        $categories = $request->query('categories', []);

        $query = Product::query();

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        $products = $query->paginate($perPage);

        return response()->json([
            'message' => 'Fetch products successful',
            'payload' => [
                'items' => $products->items(),
                'meta' => [
                    'totalItems' => $products->total(),
                    'itemCount' => count($products->items()),
                    'itemsPerPage' => $products->perPage(),
                    'totalPages' => $products->lastPage(),
                    'currentPage' => $products->currentPage(),
                ],
            ],
            'status' => true
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'exists:categories,id',
            'status' => 'nullable|string',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => $product,
            'status' => true
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|required|numeric',
            'category_id' => 'exists:categories,id',
            'status' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => $product,
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}