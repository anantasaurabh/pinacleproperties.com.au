<div style="display: flex; flex-direction: column; gap: 1.5rem; min-height: 500px;">
    <!-- Tabs Header -->
    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #374151; padding-bottom: 0;">
        <div style="display: flex; gap: 2rem;">
            <button 
                type="button"
                wire:click="$set('activeTab', 'images')"
                style="text-transform: uppercase; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.05em; padding-bottom: 1rem; border-bottom: 2px solid {{ $activeTab === 'images' ? '#f59e0b' : 'transparent' }}; color: {{ $activeTab === 'images' ? '#f59e0b' : '#9ca3af' }}; background: none; cursor: pointer; transition: all 0.2s;"
            >
                Images
            </button>
            <button 
                type="button"
                wire:click="$set('activeTab', 'files')"
                style="text-transform: uppercase; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.05em; padding-bottom: 1rem; border-bottom: 2px solid {{ $activeTab === 'files' ? '#f59e0b' : 'transparent' }}; color: {{ $activeTab === 'files' ? '#f59e0b' : '#9ca3af' }}; background: none; cursor: pointer; transition: all 0.2s;"
            >
                Files
            </button>
            <button 
                type="button"
                wire:click="$set('activeTab', 'upload')"
                style="display: flex; align-items: center; gap: 0.5rem; text-transform: uppercase; font-size: 0.875rem; font-weight: 700; letter-spacing: 0.05em; padding-bottom: 1rem; border-bottom: 2px solid {{ $activeTab === 'upload' ? '#f59e0b' : 'transparent' }}; color: {{ $activeTab === 'upload' ? '#f59e0b' : '#9ca3af' }}; background: none; cursor: pointer; transition: all 0.2s;"
            >
                <x-heroicon-m-plus-circle style="width: 1.25rem; height: 1.25rem;" />
                <span>Upload New</span>
            </button>
        </div>

        @if($activeTab !== 'upload')
            <div style="padding-bottom: 0.5rem;">
                <input 
                    wire:model.live.debounce.300ms="search"
                    type="text" 
                    placeholder="Search media..."
                    style="background-color: #1f2937; border: 1px solid #374151; font-size: 0.875rem; border-radius: 0.5rem; padding: 0.5rem 1rem; color: #ffffff; outline: none;"
                >
            </div>
        @endif
    </div>

    <!-- Content Area -->
    <div style="position: relative;">
        @if($activeTab === 'upload')
            <div style="max-width: 36rem; margin: 0 auto; padding: 2.5rem; background-color: rgba(17, 24, 39, 0.5); border-radius: 0.75rem; border: 1px solid #1f2937;">
                <form wire:submit.prevent="saveUpload" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    {{ $this->form }}
                    
                    <div style="display: flex; justify-content: flex-end; padding-top: 1rem;">
                        <x-filament::button type="submit" color="warning" size="lg" style="width: 100%;">
                            Upload and Select
                        </x-filament::button>
                    </div>
                </form>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; padding-top: 0.5rem;">
                @forelse($this->media as $item)
                    <div 
                        wire:click="selectMedia('{{ $item->file_path }}')"
                        wire:key="media-{{ $item->id }}"
                        style="position: relative; aspect-ratio: 1/1; background-color: #1f2937; border-radius: 0.75rem; border: 2px solid transparent; cursor: pointer; overflow: hidden; transition: all 0.2s;"
                        onmouseover="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 10px 15px -3px rgba(245, 158, 11, 0.1)';"
                        onmouseout="this.style.borderColor='transparent'; this.style.boxShadow='none';"
                    >
                        @if($item->file_type === 'image')
                            <img 
                                src="{{ Storage::disk('public')->url($item->file_path) }}" 
                                alt="{{ $item->title }}"
                                style="width: 100%; height: 100%; object-fit: cover;"
                            >
                        @else
                            <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1rem; text-align: center;">
                                <x-heroicon-o-document-text style="width: 3rem; height: 3rem; color: #4b5563; margin-bottom: 0.5rem;" />
                                <span style="font-size: 0.625rem; color: #9ca3af; font-weight: 500; word-break: break-all;">{{ $item->title }}</span>
                            </div>
                        @endif
                        
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 0.75rem; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); color: white; font-size: 0.625rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $item->title }}
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; padding: 5rem 0; text-align: center;">
                        <x-heroicon-o-photo style="width: 4rem; height: 4rem; color: #374151; margin: 0 auto 1rem;" />
                        <p style="color: #6b7280; font-weight: 500;">No media found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>
