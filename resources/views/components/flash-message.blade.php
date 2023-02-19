@if($message = session('message'))
        <x-alert type="success" dismissible>
            {{ $component->icon() }}
            {{ $message }}
        </x-alert>
    @endif
