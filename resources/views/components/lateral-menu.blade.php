<aside class="w-64 bg-white shadow-xl p-6 flex flex-col justify-between">
  <div>
    <a href="/welcome" class="text-2xl font-bold text-cyan-600 mb-8 block">📘 EvaluaPro</a>
    <nav class="space-y-4">
      @if(auth()->user()->rol_usuario !== 'usuario')
      <a href="/dashboard" class="flex items-center text-gray-700 hover:text-cyan-600 transition">
        <i data-feather="home" class="mr-2"></i> Dashboard
      </a>
      @endif
      <a href="/reticula_usuario" class="flex items-center text-gray-700 hover:text-cyan-600 transition">
        <i data-feather="trello" class="mr-2"></i> Reticula
      </a>
      <a href="/resultados_usuario" class="flex items-center text-gray-700 hover:text-cyan-600 transition">
        <i data-feather="bar-chart-2" class="mr-2"></i> Resultados
      </a>
    </nav>
  </div>
  <div class="text-sm text-gray-400">&copy; {{ date('Y') }} EvaluaPro</div>
</aside>
