<div class="space-y-8" x-data="{ showModal: false, message: null, messageType: null }"
    @redemption-message.window="message = $event.detail[0].message; messageType = $event.detail[0].type; setTimeout(() => { message = null }, 3000)">

    <!-- Message Display -->
    <div x-show="message" x-transition.opacity
         :class="messageType === 'error' ? 'bg-red-100 text-red-700 border-red-300' : 'bg-green-100 text-green-700 border-green-300'"
         class="fixed top-4 right-4 p-4 rounded-lg border shadow-lg z-50">
        <p x-text="message"></p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 px-4 py-2 rounded {{ session('message-type') === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ session('message') }}
        </div>
    @endif

    <!-- Email Check Section -->
    <div class="mb-12 bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Verifica tus regalito reservado</h2>
        <form wire:submit.prevent="checkRedemptions" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="email"
                       wire:model="searchEmail"
                       placeholder="Ingresa tu correo electrónico"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50">
                @error('searchEmail') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <button type="submit"
                    class="px-6 py-2 bg-pink-600 text-white font-medium rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors">
                Verificar
            </button>
        </form>
        @if($checkedRedemptions)
            @if(count($redeemedItems) > 0)
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tus artículos reservados:</h3>
                    <div class="flex flex-col gap-4">
                        @foreach($redeemedItems as $item)
                            <div class="bg-pink-50 p-6 rounded-xl shadow-sm">
                                <p class="font-semibold text-gray-900">{{ $item->name }}</p>
                                @if($item->description)
                                    <p class="text-gray-600 text-sm mt-2">{{ $item->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mt-8 p-4 bg-pink-100 text-pink-700 rounded-lg">
                    <p class="text-sm">No tienes regalitos reservados con este correo electrónico.</p>
                </div>
            @endif
        @endif
    </div>

    <!-- Available Items Grid -->
    <div class="mb-6">
        <div class="relative">
            <input type="text"
                   wire:model.debounce.300ms="search"
                   placeholder="Buscar regalos..."
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 pl-10">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($items as $item)
            <div class="bg-white rounded-xl shadow-lg p-6 transform transition-all duration-200 hover:scale-105">
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $item->name }}</h3>
                @if($item->description)
                    <p class="text-gray-600 mb-6">{{ $item->description }}</p>
                @endif
                @if(!$item->is_redeemed)
                    <button
                        wire:click="selectItem({{ $item->id }})"
                        @click="showModal = true"
                        class="w-full px-6 py-3 bg-pink-600 text-white font-medium rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors">
                        Reservar este regalo
                    </button>
                @else
                    <span class="inline-flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-medium bg-gray-100 text-gray-800">
                        Ya reservado
                    </span>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Redemption Modal -->
    <div x-show="showModal"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;"
         @gift-redeemed.window="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-4">
                                Reservar Regalo
                            </h3>
                            @if($selectedItemId)
                                <div>
                                    @livewire('redemption-form', ['itemId' => $selectedItemId])
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button type="button"
                                @click="showModal = false"
                                class="w-full px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
