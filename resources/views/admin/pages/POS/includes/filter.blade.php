<div class="mb-3">
    <form method="GET" action="" data-auto-search>
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <input type="search" style="font-size:14px;"  name="search"  value="{{ request('search') }}"
                    class="form-control"  placeholder="Search product name..."  aria-label="Search">
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex justify-content-md-end gap-2">
                    <div class="input-group shadow-sm w-auto">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-tags text-primary"></i>
                        </span>
                        <select name="category" style="font-size:14px;" 
                                class="form-select border-start-0" 
                                onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" 
                                    {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>