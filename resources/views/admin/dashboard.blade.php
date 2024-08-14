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
                <div class="p-8">
                    <h2 class="text-3xl font-bold mb-4">Admin Dashboard</h2>
                    <h3 class="text-xl font-semibold text-gray-700 mb-6">Leads</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <tr>
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-left">Phone</th>
                                    <th class="py-3 px-6 text-left">Inquiry</th>
                                    <th class="py-3 px-6 text-left">Source</th>
                                    <th class="py-3 px-6 text-left">Created At</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach($leads as $lead)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $lead->id }}</td>
                                    <td class="py-3 px-6">{{ $lead->first_name . ' ' . $lead->last_name }}</td>
                                    <td class="py-3 px-6">{{ $lead->email }}</td>
                                    <td class="py-3 px-6">{{ $lead->phone }}</td>
                                    <td class="py-3 px-6">{{ $lead->inquiry }}</td>
                                    <td class="py-3 px-6">{{ $lead->source }}</td>
                                    <td class="py-3 px-6">{{ $lead->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
