<div>
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
            <x-theme-toggle class="btn btn-circle btn-ghost" />
            <x-button label="Notifications" icon="o-bell" onclick="modal2.showModal()" class="btn-ghost btn-sm" responsive />
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
                    <button wire:click="like('{{ $article['url'] }}')" class="{{ $article['like'] ? 'text-green-500' : 'text-gray-600' }}"><i class="fas fa-thumbs-up"></i></button>
                    <button wire:click="share('{{ $article['url'] }}')" class="mr-2 ml-2"><i class="fas fa-share-alt"></i></button>
                    <button wire:click="showCommentModal('{{ $article['url'] }}')"><i class="fas fa-comment"></i></button>
                </div>
                <div class="mt-2">
                    <span>{{ $article['liked'] }}</span> Likes |
                    Comments: <span class="underline ml-2">{{ $article['comments'] ? $article['comments'] : 'None' }}</span>
                </div>
                @if(auth()->user()->email == 'admin@gmail.com')
                    <button wire:click="delete('{{ $article['url'] }}')" class="btn btn-danger mt-2">Delete</button>
                @endif
            </div>
        </div>
    @endforeach

    <x-modal  wire:model="modal6">
        <x-input label="Share" value="{{ $link }}" wire:model="link" icon="o-share" />
    </x-modal>
    <x-modal wire:model="commentModal">
        <x-form wire:submit="comment">
            <x-input label="Comment" wire:model="commentInput" />
            <x-slot:actions>
                <x-button label="Cancel" onclick="commentModal = false"  />
                <x-button label="Comment" class="btn-primary" spinner="save" type="submit" />
            </x-slot:actions>
        </x-form>
    </x-modal>
    <livewire:profile />
    <livewire:notifications />
    <livewire:view-comment />
</div>
