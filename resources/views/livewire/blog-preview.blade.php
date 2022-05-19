<div>
    
    @if( $type == 'blog' )
        <h1>{{ $data->title }}</h1>

        {!! $data->blog !!}
    @endif


    @if( $type == 'video' )

    <div class="video-wrap row justify-content-md-center">
        <iframe class="col-md-12" src="{{ $url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            {!! $data->long_description !!}
        </div>
    </div>


    @endif

</div>
