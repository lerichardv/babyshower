<div>
    @if($item)
        <p class="mb-4 text-gray-600">Estás reservando: <span class="font-semibold">{{ $item->name }}</span></p>
    @else
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            Error: Artículo no encontrado (ID: {{ $itemId }})
        </div>
    @endif

    <form wire:submit.prevent="redeem">
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Tu Nombre</label>
                <input type="text"
                       id="name"
                       wire:model.defer="name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Tu Correo Electrónico</label>
                <input type="email"
                       id="email"
                       wire:model.defer="email"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full px-6 py-3 bg-pink-600 text-white font-medium rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors">
                Reservar Regalo
            </button>
        </div>
    </form>
</div>
