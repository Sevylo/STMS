<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-xl font-bold mb-2">Total Tasks</div>
                        <div class="text-4xl font-bold text-indigo-600">{{ $totalTasks }}</div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-xl font-bold mb-2">Pending</div>
                        <div class="text-4xl font-bold text-yellow-600">{{ $pendingTasks }}</div>
                    </div>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 text-xl font-bold mb-2">Completed</div>
                        <div class="text-4xl font-bold text-green-600">{{ $completedTasks }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="mt-4">
                        <a href="{{ route('tasks.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold flex items-center gap-2">
                            Go to My Tasks
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
