<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EvaluaPro - Plataforma de Exámenes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  </head>
  <body class="bg-gradient-to-br from-blue-50 to-cyan-100 min-h-screen font-sans" >
    <div class="flex min-h-screen">
      <x-lateral-menu/>
        {{ $slot }}
    </div>
    <script>
      feather.replace();
    </script>
  </body>
  </html>