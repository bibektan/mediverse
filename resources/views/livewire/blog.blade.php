
<div>	

    <div class="row" style="margin-top: 2%">
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
                                <a class="nav-link" href="{{ route('backend.upload', ['id'=>0, 'type'=>'null']) }}">Image Upload</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>


    <div style="margin-top: 1.5%; margin-bottom: 5%">	
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-code-tab" data-bs-toggle="pill" data-bs-target="#pills-code" type="button" role="tab" aria-controls="pills-code" aria-selected="true">code</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-preview-tab" data-bs-toggle="pill" data-bs-target="#pills-preview" type="button" role="tab" aria-controls="pills-preview" aria-selected="false">preview</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-code" role="tabpanel" aria-labelledby="pills-code-tab" tabindex="0">

                @if($update)
                    <form wire:submit.prevent="update">
                @else
                    <form wire:submit.prevent="save">
                @endif

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
                    
                    @error('blog')
                        <div class="row">
                            <div class="alert alert-danger col-12 col-md-12">
                                <span class="error">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label" for="textarea">Blog</label>
                        <textarea wire:model="blog" class="form-control" id="textarea" placeholder="Be Curious!" name="blog" rows="30"></textarea>
                    </div>
                    
                    @error('title')
                        <div class="row">
                            <div class="alert alert-danger col-12 col-md-12">
                                <span class="error">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input wire:model="title" class="form-control" id="title" name="title" type="text">
                    </div>

                    @error('short_description')
                        <div class="row">
                            <div class="alert alert-danger col-12 col-md-12">
                                <span class="error">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label" for="short_description">Short Description</label>
                        <input wire:model="short_description" class="form-control" id="short_description" name="short_description" type="text">
                    </div>

                    @error('keywords')
                        <div class="row">
                            <div class="alert alert-danger col-12 col-md-12">
                                <span class="error">{{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label" for="keywords">Keywords</label>
                        <input  wire:model="keywords" class="form-control" id="keywords" name="keywords" type="text">
                    </div>

                    @if( $update )
                        <button type="submit" >Update</button>
                    @else
                        <button type="submit" >Submit</button>
                    @endif
                </form>

            </div>

            <div class="tab-pane fade" id="pills-preview" role="tabpanel" aria-labelledby="pills-preview-tab" tabindex="0">
                {!! $blog !!}
            </div>
        </div>

    </div>
</div>
