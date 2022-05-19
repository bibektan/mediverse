<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog as blo;

class Blog extends Component
{
    use WithFileUploads;

    public $blog = "";
    public $title;
    public $short_description;
    public $keywords;
    public $update = false;
    public $update_id;


    public function mount($id){
        if( $id != 0 ){
            $bb = new blo();
            $bl = $bb->where('id',$id)->get()->first();
            
            $this->update = true;
            $this->update_id = $id;

            $this->blog = $bl->blog;
            $this->title = $bl->title;
            $this->short_description = $bl->short_description;
            $this->keywords = $bl->keywords;
        }
    }

    public function update(){
        $this->validate([
            'blog' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
        ]);

        $bloge = new blo();
        $blog = $bloge->find($this->update_id);

        $blog->title = $this->title;
        $blog->short_description = $this->short_description;
        $blog->blog = $this->blog;
        $blog->keywords = $this->keywords;

        $blog->save();

        session()->flash('message', "Data saved successfully.");

        return redirect()->route('backend.blog', ['id' => 0]);
    }

    public function save()
    {
        $this->validate([
            'blog' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'keywords' => 'required',
        ]);

        $blog = new blo();

        $blog->title = $this->title;
        $blog->short_description = $this->short_description;
        $blog->blog = $this->blog;
        $blog->keywords = $this->keywords;

        $blog->save();

        session()->flash('message', "Data saved successfully.");

        return redirect()->route('backend.blog');

    }


    public function render()
    {
        return view('livewire.blog')->layout('main.app');
    }
}
