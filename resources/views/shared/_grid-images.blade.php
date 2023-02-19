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

        </div>
        </div>
    @endforeach
</div>
{{ $images->links() }}
