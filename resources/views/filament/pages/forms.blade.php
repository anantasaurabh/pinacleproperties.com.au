<x-filament-panels::page>
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden">
        <table class="w-full text-left divide-y divide-gray-200 dark:divide-white/10">
            <thead>
                <tr class="bg-gray-50 dark:bg-white/5">
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Form Name</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">Submissions</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">Last Submission</th>
                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                @foreach($forms as $form)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-950 dark:text-white">{{ $form['name'] }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $form['path'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200">
                                {{ $form['submissions'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            {{ $form['last_submission'] }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ App\Filament\Resources\FormSubmissionResource::getUrl('index', ['tableFilters[form_name][value]' => $form['raw_name']]) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg bg-white text-gray-900 ring-1 ring-gray-950/10 hover:bg-gray-50 transition-colors shadow-sm dark:bg-white/5 dark:text-white dark:ring-white/20">
                                <x-heroicon-o-eye class="w-4 h-4" />
                                View Submissions
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
