<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;
use App\Models\Meme;
use App\Models\Video;

class BackendSearch extends Component
{
    public $blogsearch;
    public $blog = [];
    public $data = [];
    public $video = [];


    public function updatedBlogsearch(){
        if($this->blogsearch != ""){
            $this->blog = Blog::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
            $this->data = Meme::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
            $this->video = Video::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
        }else{
            $this->blog = [];
            $this->data = [];
            $this->video = [];
        }
    }

    public function delete($id, $type){
        if( $type == 'blog' ){
            $b = Blog::where('id',$id)->update(['deleted' => 1]);
            if($b){
                session()->flash('success', 'Blog deleted successfully');
                $this->blog = Blog::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
            }
        }

        if( $type == 'video' ){
            $b = Video::where('id',$id)->update(['deleted' => 1]);
            if($b){
                session()->flash('success', 'Video deleted successfully');
                $this->video = Video::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
            }
        }

        if( $type == 'meme' ){
            $b = Meme::where('id',$id)->update(['deleted' => 1]);
            if($b){
                session()->flash('success', 'Meme deleted successfully');
                $this->data = Meme::where('keywords','like','%'.$this->blogsearch.'%')->where('deleted',0)->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.backend-search')->layout('main.app');
    }
}
