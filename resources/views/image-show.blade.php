<x-layout title="{{ $image->title }}">

    <div class="container-fluid mt-4">
        <div class="row">
            <x-flash-message />
            <div class="col-md-9">
                <div class="image-container">
                    <img src="{{ $image->fileUrl() }}" alt="{{ $image->title }}" class="img-fluid" />
                </div>

                @include('image.partials._related_photos', ['relatedImages' => $relatedImages])

                @include('image.partials._comments', ['comments'=>$comments])



            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ $image->user->profileImageUrl() }}" width="60"
                        alt="Author" class="rounded-circle mr-3">
                    <div class="ms-3">
                        <h5><a href="{{ $image->user->url() }}" class="text-decoration-none">
                            {{ $image->user->name }}
                        </a></h5>
                        <p class="text-muted mb-0">{{ $image->user->getImagesCount() }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between py-3 border-top border-bottom">
                    @auth
                    <div>
                    <x-form action="{{ route('likes.update', $image->slug) }}" style="display: inline;" >
                        <button type="submit" title="Like mage" class="btn
                         @if($image->hasBeenLiked())
                            btn-secondary
                         @else btn-primary
                         @endif">
                                <x-icon src="thumbs-up.svg" alt="" class="align-text-top" width="18" height="18"/> {{ $image->likes_count }}
                            </button>
                        </x-form>
                        <x-form action="{{ route('favorites.update', $image->slug) }}" style="display: inline;" >
                            <button type="submit" title="Favorite mage" class="btn
                            @if($image->hasBeenFavored())
                                btn-warning
                            @else
                                btn-danger
                            @endif" >
                                <x-icon src="heart.svg" alt="" width="18" height="18"/>
                            </button>
                        </x-form>
                    </div>

                    @else
                    <div>
                        <button type="button" title="Like mage" class="btn btn-primary" onclick="alert('You should login to like this image!')">
                            <x-icon src="thumbs-up.svg" alt="" class="align-text-top" width="18" height="18"/> {{ $image->likes_count }}
                        </button>

                        <button type="button" title="Favorite mage" class="btn btn-danger" onclick="alert('You should login to add to your favorites!')">
                            <x-icon src="heart.svg" alt="" width="18" height="18"/>
                        </button>
                    </div>
                    @endauth


                    <a href="{{ route('downloads', $image->slug) }}" title="Download" class="btn btn-success d-flex align-items-center">
                        <x-icon src="download.svg" alt="" class="align-text-top" width="18" height="18"/>
                        <span class="display-block ms-2">Download</span>
                    </a>
                </div>

                <div class="bg-light mt-3 p-3 border">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th>Uploaded</th>
                                <td>{{ $image->uploadDate }}</td>
                            </tr>
                            <tr>
                                <th>Dimensions</th>
                                <td>{{ $image->dimension }}</td>
                            </tr>
                            <tr>
                                <th>Views</th>
                                <td>{{ $image->views_count }}</td>
                            </tr>
                            <tr>
                                <th>Downloads</th>
                                <td>{{ $image->downloads_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tagcloud mt-3">

                    {{ $image->tagLinks() }}
                  {{--   <ul>
                        <li><a href="#">Nature</a></li>
                        <li><a href="#">Mountain</a></li>
                        <li><a href="#">Blue</a></li>
                        <li><a href="#">Forest</a></li>
                        <li><a href="#">Animal</a></li>
                    </ul>--}}
                </div>
            </div>
        </div>
    </div>


</x-layout>
