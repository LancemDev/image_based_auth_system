<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Mary\Traits\Toast;

class Login extends Component
{
    use Toast;
    public $username;
    public $userExists = false;
    public $images = [];
    public $selectedImages = [];

    public function search()
    {
        $user = User::where('name', $this->username)->first();

        if ($user) {
            $this->success("Username Valid");
            $this->userExists = true;

            // Get the user's selected images and decode the JSON string into an array
            $selectedImages = json_decode($user->selected_images);

            // Get all images from the public/images/auth directory
            $imageFiles = File::files(public_path('images/auth'));
            $allImages = collect($imageFiles)->map(function ($image) {
                return $image->getFilename();
            });

            // Filter out the user's selected images
            $otherImages = $allImages->diff($selectedImages);

            // Get two random images
            $randomImages = $otherImages->random(2)->toArray();

            // Merge the selected images and the random images
            $this->images = array_merge($selectedImages, $randomImages);

            // Shuffle the images
            shuffle($this->images);
        } else {
            $this->error("Username Invalid");
            $this->userExists = false;
            
        }
    }

    public function selectImage($image)
    {
        if (count($this->selectedImages) < 4) {
            $this->selectedImages[] = $image;
        }
    }
    public function save()
    {
        $user = User::where('name', $this->username)->first();

        if ($user) {
            // Get the user's registered images
            $registeredImages = json_decode($user->selected_images);

            // Count the number of matching images
            $matchingImages = array_intersect($this->selectedImages, $registeredImages);
            $numMatchingImages = count($matchingImages);

            if ($numMatchingImages >= 3) {
                // The user is allowed to log in
                auth()->login($user);
                // dd('Logged in');
                $this->success("Logged in Successfully");

                return redirect()->to('/home');

            } else {
                // The user is not allowed to log in
                // session()->flash('error', 'The selected images do not match the registered images.');
                $this->error("The selected images do not match the registered images.");
            }
        } else {
            session()->flash('error', 'User not found.');
            $this->error("User not found.");

        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}