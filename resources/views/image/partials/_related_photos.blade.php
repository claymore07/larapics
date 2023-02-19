
@if ($relatedImages->count())
    <h3 class="mt-5">Related Photos</h3>
    <div class="row mt-3">
        @foreach ($relatedImages as $image)
                <div class="col">
                    <a href="{{ $image->permaLink() }}"><img src="{{ $image->fileUrl() }}" class="img-fluid" /></a>
                </div>
        @endforeach

    </div>
@endif

