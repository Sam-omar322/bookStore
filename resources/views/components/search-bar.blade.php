<form action="{{ route('gallery.search') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="query" value="{{ request('query') }}" class="form-control" placeholder="Search for books...">
        <button type="submit" class="btn btn-outline-primary">
            <i class="fas fa-search"></i> {{ __('Search') }}
        </button>
    </div>
</form>