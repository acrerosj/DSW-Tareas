<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title">{{ __('title') }}</label>
                            <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title', $task->title) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="description">{{ __('description') }}</label>
                            <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="endtime">{{ __('endTime') }}</label>
                            <input id="endtime" class="block mt-1 w-full @if($errors->has('endtime')) border-red-500 @endif" type="date" name="endtime" value="{{ old('endtime', \Carbon\Carbon::parse($task->endtime)->format('Y-m-d')) }}"  />
                        </div>
                        @if($errors->has('endtime'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('endtime') }}</p>
                        @endif

                        <div class="mt-4">
                            <label for="completed">
                                <input id="completed" type="checkbox" name="completed" {{ old('completed', $task->completed) ? 'checked' : '' }}>
                                {{ __('completed-ckeck') }}
                            </label>
                        </div>

                        <div class="flex items mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Task') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
