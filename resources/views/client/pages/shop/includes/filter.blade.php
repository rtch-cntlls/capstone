<div class="p-3 bg-white filter">
    <h6 class="fw-bold mb-3">
        <i class="fas fa-filter me-2 text-secondary"></i>Filters
    </h6><hr>
    <div class="p-2">
        <h6 class="fw-semibold">Category:</h6>
        @foreach ($categories as $category)
            <div class="form-check mb-1">
                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->category_id }}">
                <label class="form-check-label" for="category{{ $category->category_id }}">
                    {{ $category->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>
