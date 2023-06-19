<x-app-layout>
    <div class="max-w-7xl space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Logs') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Overzicht van de logs") }}
                </p>
            </header>
            <div class="overflow-auto">
                <table class="w-full mt-4" id="customerTable">
                    <thead class="bg-white border-b-2 border-gray-400">
                        <tr>
                            <th class="py-1 px-2 text-left font-semibold">User</th>
                            <th class="py-1 px-2 text-left font-semibold">Category</th>
                            <th class="py-1 px-2 text-left font-semibold">Action</th>
                            <th class="py-1 px-2 text-left font-semibold">Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-slate-100">
                        @foreach ($logs as $log)
                        <tr class="hover:bg-slate-600 hover:text-white even:bg-slate-200 cursor-pointer">
                            <td class="py-1 px-2">{{ $log->username }}</td>
                            <td class="py-1 px-2">{{ $log->action_category }}</td>
                            <td class="py-1 px-2">{{ $log->action }}</td>
                            <td class="py-1 px-2">{{ $log->created_at->format('d-m-y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>