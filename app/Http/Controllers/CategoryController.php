<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 20);
        $page = $request->query('page', 1);
        $keyword = $request->query('keyword', '');

        $query = Category::query();

        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        $categories = $query->paginate($perPage);

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => [
                'items' => $categories->items(),
                'meta' => [
                    'totalItems' => $categories->total(), 
                    'itemCount' => count($categories->items()), 
                    'itemsPerPage' => $categories->perPage(),
                    'totalPages' => $categories->lastPage(),
                    'currentPage' => $categories->currentPage(),
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
            'status' => 'nullable|string',
        ]);

        $category = Category::create($request->all());

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => $category,
            'status' => true
        ]);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => $category,
            'status' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json([
            'message' => 'Fetch categories successfull',
            'payload' => $category,
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
