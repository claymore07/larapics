<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Blade Components</title>
</head>
<body>
    {{-- @php
        $var = "icon-info.svg"
    @endphp
    <x-icon :src="$var"/>
    <x-ui.button />
    --}}

    {{-- <x-alert  type="warning" dismissible  id="my-alert" class="mt-4 mb-4 d-flex align-items-center" role="disable">
         <x-slot name="title">
            My Message
        </x-slot>
        <x-slot:message>
            The data has been successfully submitted!
        </x-slot>
        {{ $component->icon() }}
        <p class="mb-0">The data has been successfully Removed.
            {{ $component->link("Undo") }}
        </p>
    </x-alert> --}}

    <x-alert  type="warning" dismissible  id="my-alert" class="mt-4 mb-4 " role="disable">

        {{ $component->icon() }}
        <p class="mb-0">The data has been successfully Removed.
            {{ $component->link("Undo") }}
        </p>
    </x-alert>

    <x-form  method="GET" action="/images" id="form1">
        <input type="text" name="" id="">
        <button type="submit">Submit</button>
    </x-form>
</body>
</html>
