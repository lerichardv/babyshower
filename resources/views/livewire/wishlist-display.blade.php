<div class="space-y-6" x-data="{ showModal: false, message: null, messageType: null }"
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
    <div class="mb-4 bg-white rounded-xl shadow-lg p-8">
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

    <div class="px-6 py-4 bg-pink-50 rounded-xl shadow-lg flex flex-col md:flex-row items-center justify-between gap-5">
        <svg viewBox="0 0 1024 1024" class="icon w-[80px]" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M884.4 389v101.6c0 16-13 29-29 29H570.2V360h285.1c16.1 0 29.1 13 29.1 29z" fill="#FE97AC"></path><path d="M793.6 731.9l-9 8.7 2.2 12.2-11-5.9-11 5.9 2.2-12.2-9-8.7 12.4-1.8 5.4-11.1 5.5 11.1z" fill="#EBBE3E"></path><path d="M578.2 756.8l15.1 14.7-3.6 20.8 18.7-9.8 18.7 9.8-3.5-20.8 15.1-14.7-20.9-3-9.4-18.9-9.3 18.9-20.9 3z m151.5 130l-3.6-20.8 15.1-14.7-20.9-3-9.3-18.9-9.4 18.9-20.9 3 15.1 14.7-3.5 20.8 18.7-9.9 18.7 9.9z m26.7-345.9l-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8 18.7-9.9 18.7 9.9-3.5-20.8 15.1-14.7-20.9-3-9.4-18.9zM806 727.8l-20.9-3-9.3-18.9-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8 18.7-9.8 18.7 9.8-3.6-20.8 15.1-14.7zM570.2 531.3h260v345.5c0 16-13 29-29 29h-231V531.3z m110.9 136.8l15.2-14.7-20.9-3-9.4-18.9-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8L666 679l18.7 9.9-3.6-20.8z" fill="#DC0C55"></path><path d="M683 194.9c42.3 0 76.8 34.5 76.8 76.8 0 42.4-34.5 76.8-76.8 76.8H525.1l51.9-78.6c37.6-51.9 61.9-75 106-75z" fill="#FAF7A6"></path><path d="M806 727.8l-15.1 14.7 3.6 20.8-18.7-9.8-18.7 9.8 3.6-20.8-15.1-14.7 20.9-3 9.3-18.9 9.3 18.9 20.9 3z m-21.4 12.8l8.9-8.7-12.3-1.7-5.5-11.1-5.5 11.1-12.3 1.7 8.9 8.7-2.2 12.2 11-5.8 11 5.8-2-12.2z" fill="#EF4668"></path><path d="M751 565.1l5.4-11 5.6 11 12.2 1.9-8.8 8.5 2.1 12.2-11.1-5.7-10.9 5.7 2.1-12.2-8.9-8.5z" fill="#EBBE3E"></path><path d="M771.6 577.6l3.5 20.8-18.7-9.9-18.7 9.9 3.6-20.8-15.1-14.7 20.9-3 9.3-18.9 9.4 18.9 20.9 3-15.1 14.7z m-15.2-23.5l-5.5 11-12.3 1.9 8.9 8.6-2.1 12.2 10.9-5.7 11 5.7-2.1-12.2 8.8-8.6-12.2-1.9-5.4-11z" fill="#EF4668"></path><path d="M719.8 863.9l2.1 12.2-10.9-5.7-11 5.7 2.1-12.2-8.9-8.6 12.2-1.9 5.6-11.1 5.5 11.1 12.3 1.9z" fill="#EBBE3E"></path><path d="M726.1 866l3.6 20.8-18.7-9.9-18.7 9.9 3.5-20.8-15.1-14.7 20.9-3 9.4-18.9 9.3 18.9 20.9 3-15.1 14.7z m-4.2 10.1l-2.1-12.2 8.9-8.6-12.3-1.9-5.5-11.1-5.6 11.1-12.2 1.9 8.8 8.6-2.1 12.2 11-5.7 11.1 5.7z" fill="#EF4668"></path><path d="M674.9 666l2.1 12.3-11-5.8-11 5.8 2.1-12.3-8.9-8.6 12.3-1.8 5.5-11.1 5.4 11.1 12.3 1.8z" fill="#EBBE3E"></path><path d="M666 631.4l9.4 18.9 20.9 3-15.2 14.7 3.6 20.8L666 679l-18.7 9.9 3.6-20.8-15.1-14.7 20.9-3 9.3-19z m11 46.9l-2.1-12.3 8.8-8.6-12.3-1.9-5.5-11-5.5 11-12.3 1.9 8.9 8.6-2.1 12.3 10.9-5.8 11.2 5.8z" fill="#EF4668"></path><path d="M613.9 759.1l12.2 1.8-8.8 8.7 2.1 12.2-11-5.8-11 5.8 2.1-12.2-8.9-8.7 12.3-1.8 5.5-11.1z" fill="#EBBE3E"></path><path d="M613.9 759.1l-5.6-11.1-5.5 11.1-12.3 1.7 8.9 8.7-2.1 12.2 10.9-5.8 11 5.8-2.1-12.2 8.8-8.7-12-1.7z m9.7 12.5l3.5 20.8-18.7-9.8-18.7 9.8 3.6-20.8-15.1-14.7 20.9-3 9.3-18.9 9.4 18.9 20.9 3-15.1 14.7z" fill="#EF4668"></path><path d="M570.3 143.4c21.9 38.1 18.5 76.5-11.4 128.3l-45.8 67.7-77.7-115.3c-10.1-17.4-12.5-39.4-6.7-60.2 5.7-20.8 19.2-38.4 36.7-48.7 11.8-6.7 25-10.3 38.2-10.3 6.7 0 13.5 0.9 20.1 2.7 19.7 5.4 36.4 18.1 46.6 35.8zM558.5 591.3v314.5h-91.9V360H513l0.1 0.1 0.2-0.1h45.2V531.3zM451.4 269.6l52.1 78.8H345.6c-42.4 0-76.8-34.4-76.8-76.8 0-42.3 34.4-76.8 76.8-76.8 44 0.1 68.2 23.2 105.8 74.8z" fill="#FAF7A6"></path><path d="M455 360v159.7H173.1c-16 0-29-13-29-29V389c0-16 13-29 29-29H455z" fill="#FE97AC"></path><path d="M418 760.9l-8.8 8.7 2.1 12.2-11-5.8-11 5.8 2.1-12.2-8.9-8.7 12.3-1.8 5.5-11.1 5.5 11.1z" fill="#EBBE3E"></path><path d="M409.7 753.8l20.9 3-15.1 14.7 3.5 20.8-18.7-9.8-18.7 9.8 3.6-20.8-15.1-14.7 20.9-3 9.3-18.9 9.4 18.9z m-0.5 15.8l8.8-8.7-12.2-1.7-5.6-11.1-5.5 11.1-12.3 1.7 8.9 8.7-2.1 12.2 10.9-5.8 11 5.8-1.9-12.2z" fill="#EF4668"></path><path d="M351.6 666l2.1 12.3-10.9-5.8-11.1 5.8 2.1-12.3-8.8-8.6 12.2-1.8 5.6-11.1 5.4 11.1 12.2 1.8z" fill="#EBBE3E"></path><path d="M352.1 650.3l20.9 3-15.1 14.7 3.5 20.8-18.6-9.9-18.7 9.9 3.5-20.8-15.1-14.7 20.9-3 9.4-18.9 9.3 18.9z m1.6 28l-2.1-12.3 8.8-8.6-12.2-1.9-5.5-11-5.6 11-12.2 1.9 8.8 8.6-2.1 12.3 11-5.8 11.1 5.8z" fill="#EF4668"></path><path d="M315.5 855.3l-9 8.6 2.3 12.2-11.1-5.7-11 5.7 2.2-12.2-8.9-8.6 12.3-1.9 5.4-11.1 5.5 11.1z" fill="#EBBE3E"></path><path d="M297.7 829.3l9.3 18.9 20.9 3-15.1 14.8 3.6 20.8-18.7-9.9-18.7 9.9 3.6-20.8-15.1-14.7 20.9-3 9.3-19z m5.5 24.1l-5.5-11.1-5.5 11.1-12.3 1.9 8.9 8.6-2.2 12.2 11-5.7 11 5.7-2.2-12.2 8.9-8.6-12.1-1.9z" fill="#EF4668"></path><path d="M234.4 567l12.3-1.9 5.5-11 5.6 11L270 567l-8.9 8.5 2.1 12.2-11-5.7-10.9 5.7 2.1-12.2z" fill="#EBBE3E"></path><path d="M246.7 565.1l-12.3 1.9 8.9 8.6-2.1 12.2 10.9-5.7 11 5.7-2.1-12.2 8.8-8.6-12.2-1.9-5.6-11-5.3 11z m-9.6 12.5L222 562.9l20.9-3 9.3-18.9 9.4 18.9 20.9 3-15.1 14.7 3.5 20.8-18.7-9.9-18.7 9.9 3.6-20.8z" fill="#EF4668"></path><path d="M232.9 746.9l-11 5.9 2.1-12.2-8.8-8.7 12.2-1.8 5.5-11.1 5.5 11.1 12.3 1.8-8.9 8.7 2 12.2z" fill="#EBBE3E"></path><path d="M316.4 886.8l-3.6-20.8 15.1-14.7-20.9-3-9.3-18.9-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8 18.7-9.9 18.7 9.9z m7.7-197.9l18.7-9.9 18.6 9.9-3.5-20.8 15.1-14.7-20.9-3-9.3-18.9-9.4 18.9-20.9 3 15.1 14.7-3.5 20.8z m106.5 67.9l-20.9-3-9.4-18.9-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8 18.7-9.8 18.7 9.8-3.5-20.8 15.1-14.7z m-232.3 120V531.3H455v374.5H227.4c-16.1 0-29.1-13-29.1-29z m15.9-113.5l18.7-9.8 18.7 9.8-3.6-20.8 15.1-14.7-20.9-3-9.3-18.9-9.4 18.9-20.9 3 15.1 14.7-3.5 20.8z m19.3-164.9l18.7-9.9 18.7 9.9-3.5-20.8 15.1-14.7-20.9-3-9.4-18.9-9.3 18.9-20.9 3 15.1 14.7-3.6 20.8z" fill="#DC0C55"></path><path d="M238.4 730.1l-5.5-11.1-5.6 11.1-12.2 1.7 8.8 8.7-2.1 12.2 11-5.8 10.9 5.8-2.1-12.2 8.9-8.7-12.1-1.7z m-14.9-5.3l9.4-18.9 9.3 18.9 20.9 3-15.1 14.7 3.6 20.8-18.7-9.8-18.7 9.8 3.5-20.8-15.1-14.7 20.9-3z" fill="#EF4668"></path><path d="M345.6 348.4h157.9l-52.1-78.8c-37.5-51.6-61.8-74.7-105.8-74.7-42.4 0-76.8 34.5-76.8 76.8s34.4 76.7 76.8 76.7z m213.3-76.6c29.8-51.8 33.3-90.2 11.4-128.3-10.2-17.8-26.8-30.4-46.6-35.8-6.6-1.7-13.4-2.7-20.1-2.7-13.2 0-26.4 3.6-38.2 10.3-17.5 10.2-31 27.9-36.7 48.7-5.8 20.8-3.4 42.7 6.7 60.2l77.7 115.3 45.8-67.7z m-0.4 259.5V360h-45.2l-0.1 0.1-0.2-0.1h-46.4v545.8h92V531.3zM198.3 876.8c0 16 13 29 29 29H455V531.3H198.3v345.5z m-25.2-357.1H455V360H173.1c-16 0-29 13-29 29v101.6c0 16.1 13 29.1 29 29.1zM683 348.4c42.3 0 76.8-34.4 76.8-76.8 0-42.3-34.5-76.8-76.8-76.8-44.1 0-68.4 23.1-106 74.9l-51.9 78.6H683z m118.1 557.4c16 0 29-13 29-29V531.3h-260v374.5h231z m40.7-374.5v345.5c0 22.4-18.2 40.6-40.6 40.6H227.4c-22.4 0-40.6-18.2-40.6-40.6V531.3h-13.6c-22.4 0-40.6-18.2-40.6-40.6V389c0-22.4 18.2-40.6 40.6-40.6H302c-26.7-15.2-44.7-43.9-44.7-76.8 0-48.7 39.6-88.4 88.4-88.4 29.7 0 51.1 9.1 72.1 28.5-4.8-16.1-4.9-33.9-0.2-50.9 6.6-23.7 21.9-43.9 42.2-55.5 20.4-11.8 44.2-15 67-8.8 22.9 6 41.9 20.7 53.7 41.1 17.7 30.5 20.3 62 7.9 98.5 29.7-36.3 54.6-52.8 94.9-52.8 48.7 0 88.4 39.7 88.4 88.4 0 32.9-18.1 61.5-44.8 76.8h128.8c22.4 0 40.6 18.2 40.6 40.6v101.6c0 22.4-18.2 40.6-40.6 40.6h-13.9z m13.6-11.6c16 0 29-13 29-29V389c0-16-13-29-29-29H570.2v159.7h285.2z" fill="#EF4668"></path></g></svg>
        <p class="">Puedes escoger <b>giftcards para tiendas de bebé</b>, <b>regalo en efectivo</b>, transferencias a cuenta <b>BAC 728444411</b> a nombre de Ricardo Jose Valladares ó <b>reservar de la siguiente lista:</b></p>
    </div>

    <div class="px-6 py-4 bg-blue-50 rounded-xl shadow-lg flex flex-col md:flex-row items-center gap-5">
        <svg viewBox="0 0 1024 1024" class="icon w-[40px]" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512 512m-448 0a448 448 0 1 0 896 0 448 448 0 1 0-896 0Z" fill="#2196F3"></path><path d="M469.333333 469.333333h85.333334v234.666667h-85.333334z" fill="#FFFFFF"></path><path d="M512 352m-53.333333 0a53.333333 53.333333 0 1 0 106.666666 0 53.333333 53.333333 0 1 0-106.666666 0Z" fill="#FFFFFF"></path></g></svg>
        <p class="">Puedes comprar los regalos en la tienda de tu elección. Al hacer una reservación nos aseguramos que no hayan regalos repetidos.</p>
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
