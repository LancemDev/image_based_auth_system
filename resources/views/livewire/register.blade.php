<div class="container mx-auto max-w-md p-6 outline shadow-md rounded-lg" >
<h2 class="font-mono text-2xl font-bold mb-6 text-center">Register</h2>
    <x-form wire:submit="save">
        <x-input label="Username" Placeholder="Username" wire:model.defer="username" icon="o-user" inline />
        <x-input label="Email" Placeholder="email" wire:model.defer="email" icon="o-envelope" inline />

        <x-button wire:click="getRandomImages" label="Generate Images to Set Password" class="btn-primary" />

        @if(!empty($images))
            <div class="grid grid-cols-3 gap-4">
                @foreach($images as $image)
                    <div wire:click="selectImage('{{ $image }}')" class="{{ in_array($image, $selectedImages) ? 'border-2 border-red-500' : '' }}">
                        <img src="{{ asset('images/auth/' . $image) }}" alt="Random Image" class="w-full h-auto" />
                    </div>
                @endforeach
            </div>
        @endif

        <x-slot:actions>
            <x-button label="Register" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form> 
</div>