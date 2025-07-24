<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'EvaluaPro') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .gradient-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #000000 50%, #1e40af 100%);
    }
  </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center font-sans text-gray-800">
    {{ $slot }}

    <script>
        feather.replace();
    </script>
</body>
</html>
