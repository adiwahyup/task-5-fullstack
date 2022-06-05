<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all categories 
        // Use pagination
        return CategoriesResource::collection(Category::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create/store category
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'user_id' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $category = $request->all();

        Category::create($category);

        return response()->json([
            'success' => true,
            'message' => 'Category created'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Show category detail
        return new CategoriesResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        // Update category

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $category->update([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Delete Category

        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category deleted'
        ], 200);
    }
}
