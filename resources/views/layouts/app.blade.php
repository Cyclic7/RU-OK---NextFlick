<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')


</head>
<body>
    <x-layouts.app.sidebar :title="$title ?? null">
         @include('partials.navbar')
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
</body>
</html>
