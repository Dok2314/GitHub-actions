<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\DTO\CategoryDTO;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCached();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $categoryDTO = new CategoryDTO($request->validated());
        $category = $this->categoryService->createWithCache($categoryDTO->toArray());
        return redirect()->route('categories.show', compact('category'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $categoryDTO = new CategoryDTO($request->validated());
        $category = $this->categoryService->updateWithCache($category, $categoryDTO->toArray());
        return redirect()->route('categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteWithCache($category);
        return redirect()->route('categories.index')->with('success', 'Категория успешно удалена!');
    }
}
