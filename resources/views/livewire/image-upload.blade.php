<div class="form-group">

    <div class="row" style="margin-top: 3%">
        <div class="col-12 col-md-12">
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('backend.search') }}">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.image') }}">Image Search</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.blog',['id'=>0]) }}">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>

    <div class="row" style="margin-top: 3%">
        <div class="col-6 col-md-6">
            @error('type')
                <div class="row">
                    <div class="col-3 col-md-3 align-self-start"></div>
                    <div class="alert alert-danger col-6 col-md-6 align-self-center">
                        <span class="error">{{ $message }}</span>
                    </div>
                    <div class="col-3 col-md-3 align-self-end"></div>
                </div>
            @enderror

            @if(!$update)
            <label class="form-label" for="type">Choose a file type:</label>
            <select wire:model="type" class="form-control" name="type" id="type">
                <option value="null" selected>select</option>
                <option value="image">Image</option>
                <option value="meme">Meme</option>
                <option value="video">Video</option>
            </select> 
            @endif
        </div>
        
        <div class="col-6 col-md-6 d-grid gap-2">
            @if($update)
                <button wire:click="update" class="btn btn-outline-danger" type="submit">Update</button>
            @else
                <button wire:click="save" class="btn btn-outline-danger" type="submit">Submit</button>
            @endif
        </div>

    </div>

      <div style="margin-top: 3%"></div>

        <div class="row">
            @if (session()->has('message'))
                <div class="alert alert-success col-12 col-md-12">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="row">
            @if (session()->has('warning'))
                <div class="alert alert-danger col-12 col-md-12">
                    {{ session('warning') }}
                </div>
            @endif
        </div>

        

        <div class="row">
            @if( $image_type == true || $meme_type == true )
                <div class="col-6 col-md-6">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input wire:model="photo" class="form-control" type="file" id="formFile">
                </div>
            @elseif ( $video_type == true )
                <div class="col-6 col-md-6">
                    @error('url')
                        <div class="row">
                            <div class="col-3 col-md-3 align-self-start"></div>
                            <div class="alert alert-danger col-6 col-md-6 align-self-center">
                                <span class="error">{{ $message }}</span>
                            </div>
                            <div class="col-3 col-md-3 align-self-end"></div>
                        </div>
                    @enderror
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" wire:model="url">
                </div>


                <div class="col-6 col-md-6">
                    @error('photo') 
                        <div class="row">
                            <div class="error col-12 col-md-12 alert alert-danger">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                    <label for="formFile" class="form-label">Thumbnail</label>
                    <input wire:model="photo" class="form-control" type="file" id="formFile">
                </div>
            @endif

        </div>

        <div class="row">
            <div wire:loading wire:target="photo" class="col-12 col-md-12">Uploading...</div>
        </div>

        <div class="row" style="margin-top: 3%">

            <div class="col-6 col-md-6">
                @error('keywords')
                    <div class="row">
                        <div class="col-3 col-md-3 align-self-start"></div>
                        <div class="alert alert-danger col-6 col-md-6 align-self-center">
                            <span class="error">{{ $message }}</span>
                        </div>
                        <div class="col-3 col-md-3 align-self-end"></div>
                    </div>
                @enderror
                <label class="form-label" for="keywords">Keywords</label>
                <input wire:model="keywords" class="form-control" id="keywords" name="keywords" type="text">
            </div>

            @if($meme_type == true || $video_type == true)
                <div class="col-6 col-md-6">
                    @error('title')
                        <div class="row">
                            <div class="col-3 col-md-3 align-self-start"></div>
                            <div class="alert alert-danger col-6 col-md-6 align-self-center">
                                <span class="error">{{ $message }}</span>
                            </div>
                            <div class="col-3 col-md-3 align-self-end"></div>
                        </div>
                    @enderror
                    <label class="form-label" for="title">title</label>
                    <input wire:model="title" class="form-control" id="title" name="title" type="text">
                </div>

                <div class="col-6 col-md-6 mt-3">
                    @error('short_description')
                        <div class="row">
                            <div class="col-3 col-md-3 align-self-start"></div>
                            <div class="alert alert-danger col-6 col-md-6 align-self-center">
                                <span class="error">{{ $message }}</span>
                            </div>
                            <div class="col-3 col-md-3 align-self-end"></div>
                        </div>
                    @enderror
                    <label class="form-label" for="short_description">short_description</label>
                    <input wire:model="short_description" class="form-control" id="short_description" name="short_description" type="text">
                </div>

                @endif

                @if($video_type == true)

                <div class="col-6 col-md-6 mt-3">
                    @error('duration')
                        <div class="row mt-3">
                            <div class="col-3 col-md-3 align-self-start"></div>
                            <div class="alert alert-danger col-6 col-md-6 align-self-center">
                                <span class="error">{{ $message }}</span>
                            </div>
                            <div class="col-3 col-md-3 align-self-end"></div>
                        </div>
                    @enderror
                    <label class="form-label" for="duration">duration</label>
                    <input wire:model="duration" class="form-control" id="duration" name="duration" type="text">
                </div>

                    <div class="col-12 col-md-12 mt-5">
                        @error('long_description')
                            <div class="row mt-3">
                                <div class="col-3 col-md-3 align-self-start"></div>
                                <div class="alert alert-danger col-6 col-md-6 align-self-center">
                                    <span class="error">{{ $message }}</span>
                                </div>
                                <div class="col-3 col-md-3 align-self-end"></div>
                            </div>
                        @enderror
                        <label class="form-label" for="long_description">long_description</label>
                        <textarea wire:model="long_description" class="form-control" id="long_description" name="long_description" placeholder="Be Curious!" rows="25"></textarea>
                    </div>
                @endif

        </div>

        <div class="row" style="margin-top: 3%">
        </div>

    @if ($photo)
        <div style="margin-top: 5%" class="row">
            <div class="col-md-5 col-5">
                <img src="{{ $photo->temporaryUrl() }}" class = "img-responsive" width = "100%">
            </div>
        </div>
    @endif

    @if( $update )
        <div style="margin-top: 5%" class="row">
            <div class="col-md-5 col-5">
                <img src="{{ asset('storage/photos/'.$previous_image) }}" class = "img-responsive" width = "100%">
            </div>
        </div>
    @endif

</div>