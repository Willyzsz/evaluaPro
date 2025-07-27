<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'EvaluaPro') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
    .gradient-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #000000 50%, #1e40af 100%);
    }
  </style>
</head>
<body class="gradient-bg from-blue-50 to-cyan-100 min-h-screen font-sans">
    <x-navbar-dashboard />
    {{ $slot }}

    <script>
        feather.replace();
    </script>
</body>
</html>

