@props(['tasks'])

<div>
    <table class="w-full">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">ID</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Titulo</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Descripción</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $task->title }}</td>
                    <td class="px-6 py-2 text-sm text-gray-900 dark:text-gray-100">{{ Str::limit($task->description, 100) }}</td>
                    <td>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>