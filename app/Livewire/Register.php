<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\Models\User;
use Mary\Traits\Toast;

class Register extends Component
{
    use Toast;
    public $username;
    public $email;
    public $images = [];
    public $selectedImages = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'username' => ['required', 'min:4', 'max:20'],
            'email' => ['required', 'email'],
        ]);
    }

    public function save()
    {
        $this->validate([
            'username' => ['required', 'min:4', 'max:20'],
            'email' => ['required', 'email'],
            'selectedImages' => [Rule::requiredIf(count($this->selectedImages) < 4)],
        ]);

        // Save logic here
        // dd($this->all());
        $user = new User;
        $user->name = $this->username;
        $user->email = $this->email;
        $user->selected_images = json_encode($this->selectedImages);
        $user->save();
        // dd('Saved');
        $this->success("Registered successfully");

        return redirect()->to('/home');
    }

    public function selectImage($image)
    {
        if (count($this->selectedImages) < 4) {
            $this->selectedImages[] = $image;
        }
    }

    public function getRandomImages()
    {
        $imageFiles = File::files(public_path('images/auth'));
        $images = collect($imageFiles)->map(function ($image) {
            return $image->getFilename();
        })->random(6);

        $this->images = $images;
    }

    public function render()
    {
        return view('livewire.register');
    }
}