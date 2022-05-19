<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Image;

class Imagesearch extends Component
{

    public $data = [];
    public $imagesearch = "";

    // public function mount(){
    //     $image = new Image();

    //     $this->data = $image->all();
    // }

    public function updatedImagesearch(){
        if($this->imagesearch != ""){
            $this->data = Image::where('keywords','like','%'.$this->imagesearch.'%')->get();
        }else{
            $this->data = [];
        }
    }

    public function render()
    {
        return view('livewire.imagesearch')->layout('main.app');
    }
}
