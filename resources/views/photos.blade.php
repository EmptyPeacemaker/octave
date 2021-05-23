@extends('layouts')
@section('body')
    <section class="container" style="margin-top: 60px">
        <div class="row">
            @foreach($photos as $photo)
                <div class="col-auto p-0 mt-2 ml-3">
                    <div class="card" style="width: 18rem;">
                        <img
                                src="{{$photo->url}}"
                                class="card-img-top" alt="...">
                        <div class="card-footer text-muted">Созданно {{$photo->create->format('H:i d/m/Y')}}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 mb-3">
            {{$photos->onEachSide(1)->links()}}
        </div>
    </section>
@endsection
