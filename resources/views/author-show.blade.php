<x-layout :title="$user->username">
    <section class="jumbotron-author-image-background"
     @if($user->hasCoverImage())
        style="background-image: url({{ $user->coverImageUrl() }});"
     @endif>
        <div class="jumbotron jumbotron-fluid py-4">
            <div class="container-fluid text-center">
                <h1 class="jumbotron-heading">{{ $user->username }}</h1>
                <p class="lead">{{ $user->inlineProfile() }}</p>
                <img src="{{ $user->profileImageUrl() }}" class="rounded-circle" alt="..." width="150">
                <div class="mt-3">
                    <ul class="list-unstyled list-inline">
                        @if($facebook = $user->social->facebook)
                            <li class="list-inline-item">
                                <a href="{{ $facebook }}" title="Facebook">
                                    <x-icon src="facebook.svg" alt=""/>
                                </a>
                            </li>
                        @endif
                        @if($twitter = $user->social->twitter)
                            <li class="list-inline-item">
                                <a href="{{ $twitter }}" title="Twitter">
                                    <x-icon src="twitter.svg" alt=""/>
                                </a>
                            </li>
                        @endif
                        @if($instagram = $user->social->instagram)
                            <li class="list-inline-item">
                                <a href="{{ $instagram }}" title="Instagram">
                                    <x-icon src="instagram.svg" alt=""/>
                                </a>
                            </li>
                        @endif
                        @if($website = $user->social->website)
                            <li class="list-inline-item">
                                <a href="#" title="Website">
                                    <x-icon src="website.svg" alt=""/>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-3">
        @if($images->count())
             @include("shared._grid-images", ['images' => $images])
        @else
            <x-alert type="warning">
                <h4 class="alert-heading">Wow</h4>
                <p>That's a very clean portfolio!</p>
            </x-alert>
        @endif
    </div>
</x-layout>
