<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('components.modal')
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="flex justify-center p-6">
{{--                    <button class="test-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                        Button--}}
{{--                    </button>--}}
                    <div class="w-full max-w-xs">
                        <div class="text-center">Spends for current month: <strong class="spends"></strong></div>
                        <form class="rounded px-8 pt-6 pb-8 mb-4">
                            <div class="mb-4">
                                <label class="name-label block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Product name">
                            </div>
                            <div class="mb-6">
                                <label class="price-label block text-gray-700 text-sm font-bold mb-2" for="price">
                                    Price
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="price" type="text" name="price" placeholder="Product cost">
{{--                                <p class="text-red-500 text-xs italic">Please choose a password.</p>--}}
                            </div>
                            <div class="flex justify-center">
                                @include('components.loader')
                                <button class="save w-72 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="button">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
