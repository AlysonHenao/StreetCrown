<?php
// Author: Alyson Henao

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('product.admin_list_title');
        $viewData['subtitle'] = __('product.admin_list_subtitle');
        $viewData['products'] = Product::with('category')->orderBy('id', 'desc')->get();

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('product.create_title');
        $viewData['subtitle'] = __('product.create_subtitle');
        $viewData['categories'] = Category::orderBy('name')->get();
        $viewData['exclusiveCategory'] = Category::whereRaw('LOWER(name) = ?', ['exclusive'])->first();

        return view('admin.product.create')->with('viewData', $viewData);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $this->normalizeExclusiveData($request->validated());

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', __('product.created_successfully'));
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);

        $viewData['title'] = __('product.edit_title');
        $viewData['subtitle'] = __('product.edit_subtitle');
        $viewData['product'] = $product;
        $viewData['categories'] = Category::orderBy('name')->get();
        $viewData['exclusiveCategory'] = Category::whereRaw('LOWER(name) = ?', ['exclusive'])->first();

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $data = $this->normalizeExclusiveData($request->validated());

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', __('product.updated_successfully'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', __('product.deleted_successfully'));
    }

    private function normalizeExclusiveData(array $data): array
    {
        $exclusiveCategory = Category::whereRaw('LOWER(name) = ?', ['exclusive'])->first();

        if (!$exclusiveCategory) {
            return $data;
        }

        $exclusiveCategoryId = $exclusiveCategory->getId();
        $isExclusiveChecked = (bool) $data['exclusive'];
        $selectedCategoryId = (int) $data['category_id'];

        if ($isExclusiveChecked || $selectedCategoryId === $exclusiveCategoryId) {
            $data['exclusive'] = true;
            $data['category_id'] = $exclusiveCategoryId;

            return $data;
        }

        $data['exclusive'] = false;

        return $data;
    }
}