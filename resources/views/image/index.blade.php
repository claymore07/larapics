<x-layout title="Discover free Images">

    <div class="container-fluid mt-4">
            <div class="row">
                <div class="col">
                    <a href="{{ route('images.create') }}" class="btn btn-primary">
                        <x-icon src="upload.svg" alt="Upload" class="me-2" />
                        <span>Upload</span>
                    </a>
                </div>
                <div class="col"></div>
                <div class="col text-right">
                    <form class="search-form">
                        <input type="search" name="q" placeholder="Search..." aria-label="Search..." autocomplete="off">
                    </form>
                </div>
            </div>
        </div>

     <div class="container-fluid mt-4">
        <x-flash-message />
      <div class="row image-grid" data-masonry='{"percentPosition": true }'>
        @foreach ($images as $image)
            <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card">
                <a href="{{ $image->permaLink() }}"
                ><img
                    src="{{ $image->fileUrl() }}"
                    alt="{{ $image->title }}"
                    height="100%"
                    class="card-img-top"
                /></a>
                {{-- @if(Auth::check() && Auth::user()->can('update', $image)) --}}
                @canany(['update', 'delete'], $image)
                <div class="photo-buttons">
                    @can('update', $image)
                    <a class="btn btn-sm btn-info me-2" href="{{ $image->route('edit') }}">Edit</a>
                    @endcan
                    @can('delete', $image)
                    <x-form method="DELETE" action="{{ route('images.destroy', $image->id) }}" style="display: inline;">
                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are You Sure?!')">Delete</button>
                    </x-form>
                    @endcan
                </div>
                @endcan
            </div>
            </div>
        @endforeach
      </div>
      {{ $images->links() }}
    </div>

    {{-- <a href="{{ route('images.create') }}">Upload Image</a> --}}



</x-layout>
