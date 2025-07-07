<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-4 flex gap-4">
            <a href="{{ route('produtos.index') }}" class="text-gray-700 hover:text-blue-600 @if(request()->routeIs('produtos.*')) font-bold text-blue-700 @endif">Produtos</a>
            <a href="{{ route('categorias.index') }}" class="text-gray-700 hover:text-blue-600 @if(request()->routeIs('categorias.*')) font-bold text-blue-700 @endif">Categorias</a>
            <a href="{{ route('marcas.index') }}" class="text-gray-700 hover:text-blue-600 @if(request()->routeIs('marcas.*')) font-bold text-blue-700 @endif">Marcas</a>
        </div>
    </nav>
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Modal Overlay -->
    <div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"></div>

    <script>
        function openModal(modalId) {
            document.getElementById('modal-overlay').classList.remove('hidden');
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById('modal-overlay').classList.add('hidden');
            document.getElementById(modalId).classList.add('hidden');
        }

        // Fechar modal ao clicar no overlay
        document.getElementById('modal-overlay').addEventListener('click', function() {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    closeModal(modal.id);
                }
            });
        });
    </script>
</body>
</html> 