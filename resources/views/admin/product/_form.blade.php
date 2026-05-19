{{-- Author: Alyson Henao --}}

@php
    $exclusiveCategoryId = $exclusiveCategory ? $exclusiveCategory->getId() : null;

    $selectedCategoryId = old(
        'category_id',
        $product ? $product->getCategoryId() : ''
    );

    $isExclusive = old(
        'exclusive',
        $product ? $product->getExclusive() : false
    );

    $isActive = old(
        'active',
        $product ? $product->getActive() : true
    );
@endphp

<div id="product-form-sync" data-exclusive-category-id="{{ $exclusiveCategoryId }}">
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('product.name') }}</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control"
            value="{{ old('name', $product ? $product->getName() : '') }}"
        >
    </div>

    <div class="mb-3">
        <label for="size" class="form-label">{{ __('product.size') }}</label>
        <input
            type="text"
            id="size"
            name="size"
            class="form-control"
            value="{{ old('size', $product ? $product->getSize() : '') }}"
        >
    </div>

    <div class="mb-3">
        <label for="brand" class="form-label">{{ __('product.brand') }}</label>
        <input
            type="text"
            id="brand"
            name="brand"
            class="form-control"
            value="{{ old('brand', $product ? $product->getBrand() : '') }}"
        >
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">{{ __('product.price') }}</label>
        <input
            type="number"
            id="price"
            name="price"
            class="form-control"
            min="0"
            value="{{ old('price', $product ? $product->getPrice() : '') }}"
        >
    </div>

    <div class="form-check mb-3">
        <input
            type="checkbox"
            id="exclusive"
            name="exclusive"
            value="1"
            class="form-check-input"
            {{ $isExclusive ? 'checked' : '' }}
        >
        <label for="exclusive" class="form-check-label">{{ __('product.exclusive') }}</label>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">{{ __('product.category') }}</label>
        <select id="category_id" name="category_id" class="form-select">
            <option value="">{{ __('product.select_category') }}</option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->getId() }}"
                    {{ (string) $selectedCategoryId === (string) $category->getId() ? 'selected' : '' }}
                >
                    {{ $category->getName() }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">{{ __('product.image') }}</label>
        <input
            type="text"
            id="image"
            name="image"
            class="form-control"
            value="{{ old('image', $product ? $product->getImage() : '') }}"
        >
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('product.description') }}</label>
        <textarea
            id="description"
            name="description"
            class="form-control"
            rows="3"
        >{{ old('description', $product ? $product->getDescription() : '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="color" class="form-label">{{ __('product.color') }}</label>
        <input
            type="text"
            id="color"
            name="color"
            class="form-control"
            value="{{ old('color', $product ? $product->getColor() : '') }}"
        >
    </div>

    <div class="mb-3">
        <label for="discount" class="form-label">{{ __('product.discount') }}</label>
        <input
            type="number"
            id="discount"
            name="discount"
            class="form-control"
            min="0"
            max="100"
            value="{{ old('discount', $product ? $product->getDiscount() : 0) }}"
        >
    </div>

    <div class="form-check mb-3">
        <input
            type="checkbox"
            id="active"
            name="active"
            value="1"
            class="form-check-input"
            {{ $isActive ? 'checked' : '' }}
        >
        <label for="active" class="form-check-label">{{ __('product.active') }}</label>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">{{ __('product.stock') }}</label>
        <input
            type="number"
            id="stock"
            name="stock"
            class="form-control"
            min="0"
            value="{{ old('stock', $product ? $product->getStock() : 0) }}"
        >
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            {{ $submitText }}
        </button>

        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            {{ __('product.back_button') }}
        </a>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('product-form-sync');
        const exclusiveCheckbox = document.getElementById('exclusive');
        const categorySelect = document.getElementById('category_id');

        if (!wrapper || !exclusiveCheckbox || !categorySelect) {
            return;
        }

        const exclusiveCategoryId = wrapper.dataset.exclusiveCategoryId;

        function syncFromCheckbox() {
            if (!exclusiveCategoryId) {
                return;
            }

            if (exclusiveCheckbox.checked) {
                categorySelect.value = exclusiveCategoryId;
            }
        }

        function syncFromCategory() {
            if (!exclusiveCategoryId) {
                return;
            }

            exclusiveCheckbox.checked = categorySelect.value === exclusiveCategoryId;
        }

        if (exclusiveCategoryId) {
            if (categorySelect.value === exclusiveCategoryId) {
                exclusiveCheckbox.checked = true;
            } else if (exclusiveCheckbox.checked) {
                categorySelect.value = exclusiveCategoryId;
            }
        }

        exclusiveCheckbox.addEventListener('change', syncFromCheckbox);
        categorySelect.addEventListener('change', syncFromCategory);
    });
</script>
@endpush