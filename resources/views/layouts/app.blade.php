<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
@livewireStyles
...


</head>
<body>
    <x-layouts.app.sidebar :title="$title ?? null">
         @include('partials.navbar')
        <flux:main>
            {{ $slot }}
            @livewireScripts
        </flux:main>
    </x-layouts.app.sidebar>
</body>
</html>
