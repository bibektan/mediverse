<div>

    {{-- navbar --}}
    <div class="row" style="margin-top: 1%">
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
                                <a class="nav-link" href="{{ route('backend.upload', ['id'=>0, 'type'=>'null']) }}">Image Upload</a>
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


    {{-- Search Bar --}}
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
          <div class="bg-white p-3 rounded shadow">
    
            <form action="">
                <div class="p-1 bg-light rounded rounded-pill shadow-sm ">
                  <div class="input-group">
                    <input wire:model="imagesearch" type="search" placeholder="What're you searching for?" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    <div class="input-group-append">
                      <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form>    

          </div>
        </div>
      </div>
    {{-- END Search Bar --}}




    {{-- Image Card --}}
    
    <div class="container mt-5">
        <div class="row">
            
        @foreach ($data as $k=>$v)
            <div class="card col-xs-12 col-sm-6 col-md-4 col-lg-3 ml-2">
                <div class="card-img">
                <img class="card-img-top" src="{{ asset("storage/photos/$v->image") }}" alt="Card image cap">
                </div>

                <div class="card-body">
                <div class="card-text">
                    {{-- <span>/storage/photos/{{ $v->image }}</span> --}}
                    <div class="position-relative mb-3">

                        <div id="{{$k}}" class="text-monospace d-none">
                            /storage/photos/{{ $v->image }}
                        </div>

                        <button id="{{$k}}-button" class="btn btn-sm btn-light shadow bg-body rounded" onclick="copyText('{{$k}}');" title="Copy Text">Copy</button>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
                
        </div>
    </div>

    {{-- END Image Card --}}


</div>
