@props([
    'title' => "Skoopski Potatoes!"
])

<!DOCTYPE html>
<html lang="en" data-theme="synthwave">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- DaisyUI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>

<body>

<x-nav/>
<!-- MAIN CONTENT -->
<main class="max-w-3xl mx-auto p-6 mt-6">
    <div class="prose prose-invert">
        {{ $slot }}
    </div>
</main>

</body>
</html>
