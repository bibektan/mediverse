<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blog;
use App\Models\Video;

class BlogPreview extends Component
{

    public $data;
    public $type;

    public $url;

    public function mount($id, $type){
        $this->type = $type;

        if( $type == 'blog' ){
            $blog = new Blog();
            $b = $blog->where('id',$id)->get()->first();
            $this->data = $b;
        }

        if( $type == 'video' ){

            
            $v = new Video();
            $vi = $v->where('id',$id)->get()->first();
            $this->data = $vi;
            
            $vi_uri = $vi->video;
            $conv_uri = str_replace("watch?v=", "embed/", $vi_uri);

            $this->url = $conv_uri;
            // dd($vi_uri);
            // dd($conv_uri);
        }
    }

    public function render()
    {
        return view('livewire.blog-preview')->layout('main.app');
    }
}
