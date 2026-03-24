<?php

// Author: Alyson Henao

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('category.admin_list_title');
        $viewData['subtitle'] = __('category.admin_list_subtitle');
        $viewData['categories'] = Category::orderBy('id', 'desc')->get();

        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('category.create_title');
        $viewData['subtitle'] = __('category.create_subtitle');

        return view('admin.category.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index')->with('success', __('category.created_successfully'));
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $category = Category::findOrFail($id);

        $viewData['title'] = __('category.edit_title');
        $viewData['subtitle'] = __('category.edit_subtitle');
        $viewData['category'] = $category;

        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(UpdateCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.category.index')->with('success', __('category.updated_successfully'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::with('products')->findOrFail($id);

        if ($category->getProducts()->count() > 0) {
            return redirect()
                ->route('admin.category.index')
                ->with('error', __('category.delete_blocked'));
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', __('category.deleted_successfully'));
    }
}
