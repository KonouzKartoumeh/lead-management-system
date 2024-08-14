<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-800 text-white text-center">
                    <h1 class="text-2xl font-semibold">Hello Admin</h1>
                </div>

            </div>
        </div>
    </div>
    
</x-app-layout>
