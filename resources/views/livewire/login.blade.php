<div class="container mx-auto max-w-md p-6 outline shadow-md rounded-lg">
<!-- <a class="underline" href="register">Don't have an Account? Register Here</a> -->
<h2 class="font-mono text-2xl font-bold mb-6 text-center">Login</h2>
    <x-form  wire:submit="save">
        <x-input label="Username" type="Username" wire:model="username" icon="o-user" />
        <x-button label="Search For Username" class="btn-primary" wire:click="search" spinner="save" />
        @if($userExists)
            <div class="grid grid-cols-3 gap-4">
                @foreach($images as $image)
                    <div wire:click="selectImage('{{ $image }}')" class="{{ in_array($image, $selectedImages) ? 'border-2 border-red-500' : '' }}">
                        <img src="{{ asset('images/auth/' . $image) }}" alt="Random Image" class="w-full h-auto" />
                    </div>
                @endforeach
            </div>
        @endif
        
        <x-slot:actions>
        <a class="font-sans underline" href="register">Don't have an Account? Register Here</a>
            <x-button label="Log In" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form> 
</div>
