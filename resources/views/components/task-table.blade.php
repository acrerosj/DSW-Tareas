@props(['tasks'])

<div>
    <table class="w-full">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">ID</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Usuario') }}</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Fecha_Vencimiento') }}</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('title') }}</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('description') }}</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Acciones') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 @if($task->completed) bg-red-100 dark:bg-red-700 hover:bg-red-200 dark:hover:bg-red-600 @endif">
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $task->user->name }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ Carbon\Carbon::parse($task->endtime)->format('d/m/Y') }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $task->title }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($task->description, 100) }}</td>
                    <td>
                        @if(Auth::check() && Auth::id() === $task->user_id)                       
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>