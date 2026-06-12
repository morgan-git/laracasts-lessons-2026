@props([
    'title' => "Skoopski Potatoes!"
])

<!DOCTYPE html>
<html lang="en" data-theme="darkwave">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-primary">

<x-nav/>
<!-- MAIN CONTENT -->
<main class="max-w-3xl mx-auto p-6 mt-6">
    <div class="prose prose-invert">
        {{ $slot }}
    </div>
</main>

</body>
</html>
