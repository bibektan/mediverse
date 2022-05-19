<div>
    
    {{-- navbar --}}
    <div class="row" style="margin-top: 1%">
        <div class="col-12 col-md-12">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('backend.search', ['id'=>0]) }}">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.upload', ['id'=>0, 'type'=>'null']) }}">Upload</a>
                            </li>
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
    {{-- END navbar --}}





    <div style="margin-top: 1.5%; margin-bottom: 5%">	
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

            <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-blog-tab" data-bs-toggle="pill" data-bs-target="#pills-blog" type="button" role="tab" aria-controls="pills-blog" aria-selected="true">blog</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-video-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">video</button>
            </li>

            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-meme-tab" data-bs-toggle="pill" data-bs-target="#pills-meme" type="button" role="tab" aria-controls="pills-meme" aria-selected="false">meme</button>
            </li>


        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            {{-- blog --}}
            <div class="tab-pane fade show active" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab" tabindex="0">

                <div class="row mt-3">

                    <div class="row">
                        @if (session()->has('success'))
                            <div class="alert alert-success col-12 col-md-12">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    @foreach ($blog as $k=>$v)
                        <div class="col-lg-10 col-10 col-md-10 mx-auto">
                            <div class="bg-light rounded rounded-pill shadow">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title"><a href="{{route('backend.blog.preview',['id'=>$v->id])}}">{{$v->title}}</a></h5>
                                    <p class="card-text">{{ $v->short_description }}</p>
                                    </div>
                                </div>  
            
                            </div>
                        </div>

                        <div class="col-md-2 mx-auto">
                            <div class=" bg-light rounded shadow">
                                <div class="row">
                                    <div class="col-md-6 fs-5 justify-content-center text-center">
                                        <i wire:click="restore({{$v->id}}, 'blog')" style="cursor: pointer" class="fa fa-download text-success"></i>
                                    </div>
                                    <div class="col-md-6 fs-5 justify-content-center text-center">
                                        <i wire:click="delete({{$v->id}}, 'blog')" style="cursor: pointer" class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
            
                </div>

            </div>


            {{-- video --}}
            <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab" tabindex="0">

                
                @foreach ($video as $k=>$v)
                
                    <div class="row mt-3 bg-light rounded shadow">
                        <div style="width: 360px" class="col-md-4">
                            <div class="card card-block">
                                <img class="img-responsive img-fluid rounded" src="{{ asset("storage/photos/$v->thumbnail") }}">
                                <div class="card-img-overlay">
                                    <div class="duration" style="
                                    padding: 3px;
                                    background-color: black;
                                    color: white;
                                    display: inline;" >{{ $v->duration }}</div>
                                  </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-block">
                                <h5 class="card-title"><a href="">{{$v->title}}</a></h5>
                                <p class="card-text">{{ $v->short_description }}</p>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-md-2 mx-auto">
                            <div class=" bg-light rounded shadow">
                                <div class="row">
                                    <div class="col-md-6 fs-5 justify-content-center text-center">
                                        <i wire:click="restore({{$v->id}}, 'video')" style="cursor: pointer" class="fa fa-download text-success"></i>
                                    </div>
                                    <div class="col-md-6 fs-5 justify-content-center text-center">
                                        <i wire:click="delete({{$v->id}}, 'video')" style="cursor: pointer" class="fa fa-trash text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
            

            </div>


            {{-- memes --}}
            <div class="tab-pane fade" id="pills-meme" role="tabpanel" aria-labelledby="pills-meme-tab" tabindex="0">

                <div class="container mt-5">
                    <div class="row">
                        
                    @foreach ($data as $k=>$v)
                        <div class="card col-xs-12 col-sm-4 col-md-4 col-lg-3 ml-2">
                            <div class="card-img">

                            <div class="pop" style="cursor: pointer">
                                <img class="card-img-top" src="{{ asset("storage/photos/$v->meme") }}" data-bs-toggle="tooltip" data-bs-placement="top" title="click to see full picture">
                            </div>

                            <script>
                                $(function() {
                                  $('.pop').on('click', function() {
                                  console.log('clicked');
                                  $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                                  $('#imagemodal').modal('show');   
                                  });		
                              });
                            </script>


                            </div>
            
                            <div class="card-body">
                            <h5 class="card-title"><a href="">{{ $v->title }}</a></h5>
                            <div class="card-text">
                                {{-- <span>/storage/photos/{{ $v->image }}</span> --}}
                                <div class="position-relative mb-3">
                                    <p>{{ $v->short_description }}</p>
                                </div>

                                <div class="mx-auto">
                                    <div class=" bg-light rounded shadow">
                                        <div class="row">
                                            <div class="col-md-6 fs-5 justify-content-center text-center">
                                                <i wire:click="restore({{$v->id}}, 'meme')" style="cursor: pointer" class="fa fa-download text-success"></i>
                                            </div>
                                            <div class="col-md-6 fs-5 justify-content-center text-center">
                                                <i wire:click="delete({{$v->id}}, 'meme')" style="cursor: pointer" class="fa fa-trash text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                            
                    </div>
                </div>

            </div>



        </div>

    </div>

    {{-- END Search Result --}}

    
<div class="modal" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">              
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <img src="" class="imagepreview">
        </div>
      </div>
    </div>
  </div>

    


</div>

