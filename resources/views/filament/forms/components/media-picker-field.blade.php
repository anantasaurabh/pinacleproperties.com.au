<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div 
        x-data="{ 
            state: $wire.$entangle('{{ $getStatePath() }}') 
        }" 
        @media-selected.window="
            if ($event.detail.statePath === '{{ $getStatePath() }}') { 
                state = $event.detail.filePath;
                
                // Absolute bulletproof way to close ANY Filament modal
                const closeBtn = document.querySelector('[data-filament-modal-close-button]') || 
                                 document.querySelector('.fi-modal-close-btn') ||
                                 document.querySelector('.filament-modal-close-button');
                if (closeBtn) closeBtn.click();
            }
        "
        class="relative group inline-block"
    >
        <div 
            @click="$wire.mountFormComponentAction('{{ $getStatePath() }}', 'browse_library')"
            class="relative bg-gray-100 dark:bg-gray-800 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700 hover:border-warning-500 dark:hover:border-warning-500 transition-all cursor-pointer overflow-hidden flex items-center justify-center"
            style="min-height: 150px; max-height: 150px; width: auto; min-width: 200px;"
        >
            <template x-if="state">
                <img :src="'/storage/' + state" class="h-full w-auto object-contain" style="max-height: 150px;">
            </template>
            
            <template x-if="!state">
                <div class="flex flex-col items-center justify-center text-gray-400 group-hover:text-warning-500 transition-colors">
                    <x-heroicon-o-photo class="w-12 h-12 mb-2" />
                    <span class="text-sm font-medium">Click to browse Media Library</span>
                </div>
            </template>

            <!-- Hover Overlay -->
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <x-filament::button color="warning" size="sm" icon="heroicon-m-pencil-square" type="button">
                    Change Image
                </x-filament::button>
            </div>
        </div>

        <template x-if="state">
            <button 
                type="button"
                @click="state = null"
                style="position: absolute; top: -8px; right: -8px; background-color: #ef4444; color: white; border-radius: 9999px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 2px solid white; cursor: pointer; z-index: 50;"
            >
                <x-heroicon-m-x-mark style="width: 14px; height: 14px;" />
            </button>
        </template>
    </div>
</x-dynamic-component>
