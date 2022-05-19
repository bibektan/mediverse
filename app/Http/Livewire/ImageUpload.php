<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Meme;
use App\Models\Video;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $keywords;
    public $type;
    public $title;
    public $short_description;
    public $long_description;
    public $url;
    public $duration;

    public $update = false;
    public $update_id;

    public $image_type = false;
    public $meme_type = false;
    public $video_type = false;

    public $previous_image;


    public function mount($id, $type){
        if($id != 0 & ( $type == 'meme' || $type == 'video' ) ){
            $this->update = true;
            $this->update_id = $id;
            $this->type = $type;

            if( $type == 'meme' ){
                $this->meme_type = true;
                $this->image_type = false;
                $this->video_type = false;

                $me = new Meme();
                $meme = $me->where('id', $id)->get()->first();

                $this->keywords = $meme->keywords;
                $this->title = $meme->title;
                $this->short_description = $meme->short_description;
                $this->previous_image = $meme->meme;
            }
            if( $type == 'video' ){
                $this->meme_type = false;
                $this->image_type = false;
                $this->video_type = true;

                $data = new Video();
                $vid = $data->where('id', $id)->get()->first();

                $this->url = $vid->video;
                $this->keywords = $vid->keywords;
                $this->title = $vid->title;
                $this->short_description = $vid->short_description;
                $this->duration = $vid->duration;
                $this->long_description = $vid->long_description;
                $this->previous_image = $vid->thumbnail;
            }
        }
    }



    public function update(){
        // photo null
        if( $this->photo == null ){
            if( $this->type == 'video' ){
                $this->validate([
                    'previous_image' => 'required',
                    'url' => 'required|url',
                    'keywords' => 'required',
                    'title' => 'required',
                    'short_description' => 'required',
                    'duration' => 'required',
                    'long_description' => 'required'
                ]);
            }

            if( $this->type == 'meme' ){
                $this->validate([
                    'previous_image' => 'required',
                    'keywords' => 'required',
                    'title' => 'required',
                    'short_description' => 'required'
                ]);
            }

            $memeee = new Meme();
            $meme = $memeee->find($this->update_id);
            if( $this->type == "meme" ){
                $meme->title = $this->title;
                $meme->short_description = $this->short_description;
                $meme->meme = $this->previous_image;
                $meme->keywords = $this->keywords;
                $meme->save();
            }

            $videe = new Video();
            $video = $videe->find($this->update_id);
            if( $this->type == "video" ){
                $video->title = $this->title;
                $video->thumbnail = $this->previous_image;
                $video->short_description = $this->short_description;
                $video->long_description = $this->long_description;
                $video->video = $this->url;
                $video->keywords = $this->keywords;
                $video->duration = $this->duration;
                $video->save();
            }

            session()->flash('message', 'File Updated Successfully.');
            return redirect()->route('backend.upload', ['id'=>0,'type'=>'null']);

        }
        // END photo null


        // photo uploaded
        if( $this->photo != null ){
            if( $this->type == 'video' ){
                $this->validate([
                    'photo' => 'image|max:5000',
                    'url' => 'required|url',
                    'keywords' => 'required',
                    'title' => 'required',
                    'short_description' => 'required',
                    'duration' => 'required',
                    'long_description' => 'required'
                ]);
            }

            if( $this->type == 'meme' ){
                $this->validate([
                    'photo' => 'image|max:5000',
                    'keywords' => 'required',
                    'title' => 'required',
                    'short_description' => 'required'
                ]);
            }

            $fileNameWithExtension = $this->photo->getClientOriginalName();

            $fileNameWithoutExtension = str_replace('.', ' ', $fileNameWithExtension);

            $originalName = explode(' ',  $fileNameWithoutExtension)[0];

            $get_extension = $this->photo->extension();

            $milliseconds = floor(microtime(true) * 1000);

            $filename = $originalName.$milliseconds.".".$get_extension;

            $this->photo->storeAs('photos', $filename, 'public');

            $meme_me = new Meme();
            $meme = $meme_me->find($this->update_id);
            if( $this->type == "meme" ){
                $meme->title = $this->title;
                $meme->short_description = $this->short_description;
                $meme->meme = $filename;
                $meme->keywords = $this->keywords;
                $meme->save();
            }

            $video_eo = new Video();
            $video = $video_eo->find($this->update_id);
            if( $this->type == "video" ){
                $video->title = $this->title;
                $video->thumbnail = $filename;
                $video->short_description = $this->short_description;
                $video->long_description = $this->long_description;
                $video->video = $this->url;
                $video->keywords = $this->keywords;
                $video->duration = $this->duration;
                $video->save();
            }

            session()->flash('message', 'File Updated Successfully.');
            Storage::deleteDirectory('livewire-tmp');
            Storage::delete('/public/photos/'.$this->previous_image);
            return redirect()->route('backend.upload', ['id'=>0,'type'=>'null']);
        }
        // END photo uploaded

    }

    public function save()
    {
        $this->validate([
            'type' => 'required|in:meme,image,video'
        ]);

        if($this->type == "image"){
            $this->validate([
                'photo' => 'image|max:5000',
                'keywords' => 'required'
            ]);
        }

        if($this->type == "meme"){
            $this->validate([
                'photo' => 'image|max:5000',
                'keywords' => 'required',
                'title' => 'required',
                'short_description' => 'required'
            ]);
        }

        if($this->type == "video"){
            $this->validate([
                'photo' => 'image|max:5000',
                'url' => 'required|url',
                'keywords' => 'required',
                'title' => 'required',
                'short_description' => 'required',
                'duration' => 'required',
                'long_description' => 'required'
            ]);
        }

        $fileNameWithExtension = $this->photo->getClientOriginalName();

        $fileNameWithoutExtension = str_replace('.', ' ', $fileNameWithExtension);

        $originalName = explode(' ',  $fileNameWithoutExtension)[0];

        $get_extension = $this->photo->extension();

        $milliseconds = floor(microtime(true) * 1000);

        $filename = $originalName.$milliseconds.".".$get_extension;

        $this->photo->storeAs('photos', $filename, 'public');

        $image = new Image();
        if( $this->type == "image" ){
            $image->image = $filename;
            $image->keywords = $this->keywords;
            $image->save();
        }

        $meme = new Meme();
        if( $this->type == "meme" ){
            $meme->title = $this->title;
            $meme->short_description = $this->short_description;
            $meme->meme = $filename;
            $meme->keywords = $this->keywords;
            $meme->save();
        }

        $video = new Video();
        if( $this->type == "video" ){
            $video->title = $this->title;
            $video->thumbnail = $filename;
            $video->short_description = $this->short_description;
            $video->long_description = $this->long_description;
            $video->video = $this->url;
            $video->keywords = $this->keywords;
            $video->duration = $this->duration;
            $video->save();
        }

        session()->flash('message', 'File successfully uploaded.');
        $sto_delete = Storage::deleteDirectory('livewire-tmp');
        return redirect()->route('backend.upload', ['id'=>0,'type'=>'null']);
 
    }

    public function updatedType(){
        if( $this->type == 'image' ){
            $this->image_type = true;
            $this->meme_type = false;
            $this->video_type = false;
        }

        if( $this->type == 'meme'){
            $this->meme_type = true;
            $this->image_type = false;
            $this->video_type = false;
        }

        if( $this->type == 'video' ){
            $this->meme_type = false;
            $this->image_type = false;
            $this->video_type = true;
        }

        if( $this->type == 'null' ){
            $this->meme_type = false;
            $this->image_type = false;
            $this->video_type = false;
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5000',
        ]);
    }


    public function render()
    {
        return view('livewire.image-upload')->layout('main.app');
    }
}
