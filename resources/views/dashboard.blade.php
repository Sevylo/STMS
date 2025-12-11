<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openCreate: false, openEdit: false, editingTask: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Flash Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Actions Bar -->
            <div class="flex justify-end px-4 sm:px-0">
                <button @click="openCreate = true" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition duration-150 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create Task
                </button>
            </div>

            <!-- Create Task Modal -->
            <div x-show="openCreate" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="fixed inset-0 bg-gray-900 opacity-50 backdrop-blur-sm" @click="openCreate = false"></div>
                <div class="relative min-h-screen flex items-center justify-center p-4">
                    <div class="relative bg-white rounded-xl shadow-2xl max-w-lg w-full p-6 transform transition-all">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Task</h3>
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Deadline</label>
                                        <input type="datetime-local" name="deadline" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Priority</label>
                                        <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="low">Low</option>
                                            <option value="medium" selected>Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button" @click="openCreate = false" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Save Task</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Task List Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tasks as $task)
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl hover:shadow-lg transition-shadow duration-300 border-l-4 {{ $task->priority === 'high' ? 'border-red-500' : ($task->priority === 'medium' ? 'border-yellow-500' : 'border-green-500') }}">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg text-gray-800 truncate pr-2" title="{{ $task->title }}">{{ $task->title }}</h3>
                                <div class="flex items-center gap-1">
                                    <span class="text-xs text-gray-500 font-medium">Status:</span>
                                    <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 h-10">{{ $task->description ?? 'No description' }}</p>
                            
                            <div class="flex items-center text-xs text-gray-500 mb-4 gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y h:i A') }}</span>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-sm font-medium {{ $task->status === 'completed' ? 'text-yellow-600 hover:text-yellow-700' : 'text-green-600 hover:text-green-700' }}">
                                        {{ $task->status === 'completed' ? 'Mark Pending' : 'Mark Done' }}
                                    </button>
                                </form>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-500 hover:text-indigo-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($tasks->isEmpty())
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    <p>No tasks found. Create one to get started!</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
