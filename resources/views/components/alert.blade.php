<div  {{ $attributes->merge(['class' => $getClasses,'role'=> $attributes->prepends('action')])
 }} >
    @isset($title)
        <h1 class="alert-heading">{{ $title }}</h1>
    @endisset
    @isset($message)
        <p class="mb-0">{{ $message }}</p>
    @endisset

    {{ $slot }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>



{{-- <div class="alert alert-{{ $validType }}" {{ $attributes }}>
    Alert
</div> --}}

{{-- <div  {{ $attributes->class(['alert-dismissible fade show' => $dismissible])->merge(['class' => "alert alert-{$validType}",'role'=> $attributes->prepends('action')])
 }} >
    @isset($title)
        <h2 class="alert-heading">{{ $title }}</h2>
    @endisset

    @isset($message)
        <p class="mb-0">{{ $message }}</p>
    @endisset

    {{ $slot }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div> --}}



