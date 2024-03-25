<div>
    <x-modal id="modal1" class="backdrop-blur">   
    <div class="flex justify-between items-center">
        <h2 class="font-mono text-2xl font-bold mb-6 text-center">View Profile</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-menu>
                <x-menu-item title="Logout" icon="s-chevron-left" onclick="event.preventDefault(); this.closest('form').submit();" />
            </x-menu>
        </form>
    </div>
   <x-form wire:submit="update">
        <x-input label="Update Username" Placeholder="Username" wire:model.defer="username" icon="o-user" />
        <x-input label="Update Email" Placeholder="email" wire:model.defer="email" icon="o-envelope" />

        <x-slot:actions>
            <x-button label="Cancel" onclick="modal1.close()"  />
            <x-button label="Update User Details" class="btn-primary" spinner="save" type="submit" />
        </x-slot:actions>
    </x-form>
        
    </x-modal>
</div>