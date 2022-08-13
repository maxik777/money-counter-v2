<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>
    @include('components.modal')
    @include('components.modal-delete')
    <div class="py-12">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mt-5">
                    <h2 class="text-center mb-4">Report for: <?=date('M, Y')?></h2>
                    <h6 hidden class="selected-items-wrapper text-center mb-4">Price for selected items: <bold><span class="selected-items-price"></span></bold></h6>
                    <h6 class="leftover-items-wrapper text-center mb-4">Leftover sum: <bold><span class="leftover-items-price"></span></bold></h6>
                    <table class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
{{--                <div class="flex justify-center p-6 bg-white border-b border-gray-200">--}}
{{--                    <button class="test-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                        Button--}}
{{--                    </button>--}}
{{--                    <div class="w-full max-w-xs">--}}
{{--                        <div>Spends for current month: <strong class="spends"></strong></div>--}}
{{--                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">--}}
{{--                            <div class="mb-4">--}}
{{--                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">--}}
{{--                                    Name--}}
{{--                                </label>--}}
{{--                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Product name">--}}
{{--                            </div>--}}
{{--                            <div class="mb-6">--}}
{{--                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">--}}
{{--                                    Price--}}
{{--                                </label>--}}
{{--                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="price" type="text" placeholder="Product cost">--}}
{{--                                --}}{{--                                <p class="text-red-500 text-xs italic">Please choose a password.</p>--}}
{{--                            </div>--}}
{{--                            <div class="flex justify-center">--}}
{{--                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">--}}
{{--                                    Save--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                        <p class="text-center text-gray-500 text-xs">--}}
{{--                            &copy;2020 Acme Corp. All rights reserved.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <style>
        .toast-success {
            background-color: #51a351!important;
        }
        .toast-error {
            background-color:#BD362F!important;
        }
    </style>
</x-app-layout>

