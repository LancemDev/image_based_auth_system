<div class="">
    <x-nav sticky full-width>
        
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <div>NewsApp</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-button label="Notifications" icon="o-bell" onclick="modal2.showModal()" class="btn-ghost btn-sm" responsive />
            <x-theme-toggle />
            <x-button label="{{ auth()->user()->name }}" icon="o-user" onclick="modal1.showModal()"  class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-nav>

    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
        <x-menu activate-by-route>
            <x-menu-item title="Home" icon="o-home" link="###" />
            <x-menu-item title="Messages" icon="o-envelope" link="###" />
        </x-menu>
    </x-slot:sidebar>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($news as $article)
        <div class="card">
            <img src="{{ $article['urlToImage'] }}" alt="News Image">
            <div class="card-body">
                <h5 class="card-title">{{ $article['title'] }}</h5>
                <p class="card-text">{{ $article['description'] }}</p>
                <a href="{{ $article['url'] }}" class="btn btn-primary" target="_blank">Read More</a>
                <div class="mt-2">
                    <button><i class="fas fa-thumbs-up"></i></button>
                    <button wire:click="share('{{ $article['url'] }}')"><i class="fas fa-share-alt"></i></button>
                    <button><i class="fas fa-comment"></i></button>
                </div>
            </div>
        </div>
    @endforeach

    <x-modal class="backdrop-blur" wire:model="modal6">
        <x-input label="Copy Link" value="{{ $link }}" wire:model="link" icon="o-share" />
    </x-modal>
</div>

<livewire:profile />
<livewire:notifications />
<livewire:make-comment />
<livewire:view-comment />




</div>
