<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;
use App\Models\Meme;
use App\Models\Video;

class RecycleBin extends Component
{

    public $blog = [];
    public $data = [];
    public $video = [];

    public function mount(){
        $blog = new Blog();
        $this->blog = $blog->where('deleted',1)->get();

        $data = new Meme();
        $this->data = $data->where('deleted',1)->get();

        $video = new Video();
        $this->video = $video->where('deleted',1)->get();
    }

    public function delete($id, $type){


        if( $type == 'blog' ){
            $b = Blog::where('id',$id)->delete();
            if($b){
                session()->flash('success', 'Blog Permanently deleted');
                $this->blog = Blog::where('deleted',1)->get();
            }
        }

        if( $type == 'video' ){
            $b = Video::where('id',$id)->delete();
            if($b){
                session()->flash('success', 'Video Permanently deleted');
                $this->video = Video::where('deleted',1)->get();
            }
        }

        if( $type == 'meme' ){
            $b = Meme::where('id',$id)->delete();
            if($b){
                session()->flash('success', 'Meme Permanently deleted');
                $this->data = Meme::where('deleted',1)->get();
            }
        }
    }




    public function restore($id, $type){
        if( $type == 'blog' ){
            $b = Blog::where('id',$id)->update(['deleted' => 0]);
            if($b){
                session()->flash('success', 'Blog Restored successfully');
                $this->blog = Blog::where('deleted',1)->get();
            }
        }

        if( $type == 'video' ){
            $b = Video::where('id',$id)->update(['deleted' => 0]);
            if($b){
                session()->flash('success', 'Video Restored successfully');
                $this->video = Video::where('deleted',1)->get();
            }
        }

        if( $type == 'meme' ){
            $b = Meme::where('id',$id)->update(['deleted' => 0]);
            if($b){
                session()->flash('success', 'Meme Restored successfully');
                $this->data = Meme::where('deleted',1)->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.recycle-bin')->layout('main.app');
    }
}
