@extends('layouts')
@section('body')
    <section class="container" style="margin-top: 60px">
        <div class="row">
            @foreach($spectacles as $spectacle)
                <div class="col-auto p-0 mt-2 ml-3" style="position: relative">
                    <div class="card" style="width: 18rem;height: 350px;">
                        <img
                                src="{{$spectacle->url}}"
                                class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"
                                style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$spectacle->title}}</h5>
                            <p class="card-text"
                               style="max-height: 75px;overflow: hidden">{{$spectacle->description}}</p>

                        </div>
                        <div class="card-footer text-muted">
                            Созданно {{$spectacle->created_at->format('H:i d/m/Y')}}</div>
                    </div>
                    <div class="hover-card w-100 h-100 top-0"
                         data-id="{{$spectacle->id}}"
                         data-date="{{$spectacle->created_at->format('H:i d/m/Y')}}"
                         data-url="{{$spectacle->url}}"
                         data-title="{{$spectacle->title}}"
                         data-text="{{$spectacle->text}}"
                         data-description="{{$spectacle->description}}"
                         data-comments="{{$spectacle->comments}}"
                         style="position: absolute;border-radius: 0.25em"></div>
                </div>
            @endforeach
        </div>
        <div class="mt-3 mb-3">
            {{$spectacles->onEachSide(1)->links()}}
        </div>
    </section>
    <div class="modal fade" id="addSpectacle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
         data-edit="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Спектакль</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center flex-column">
                    <img src="" id="url" alt="" style="border-radius: 4px">
                    <hr class="w-75 m-2">
                    <div id="text" class="mb-3"></div>
                    <hr class="w-75 m-2">
                    <div id="comment"></div>
                    <hr class="w-75 m-2">
                    <form class="container">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label">Автор</label>
                            <input type="text" class="form-control" id="authComment" required>
                        </div>
                        <div class="mb-1">
                            <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
                            <textarea class="form-control" id="textComment" rows="3" required></textarea>
                        </div>
                        <div class="btn btn-success" id="addComment">Добавить</div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <style>
        .hover-card {
            background-color: rgba(0, 0, 0, 0.25);
            transition: background-color ease-out 500ms;
        }

        .hover-card:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0);
        }
    </style>
    <script>
        $('#addComment').click(function () {
            $.ajax({
                type:'POST',
                url:'{{route('comment')}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    auth: $('#authComment').val(),
                    text: $('#textComment').val(),
                    id: $('#addComment').data('id')
                },
                dataType: 'JSON',
                success: (response)=>{
                    window.location.reload()
                }
            })
        });

        let char=(int)=>int>10?int:'0'+int;

        $('.hover-card').click(function () {
            $('.modal-footer').html('Созданно ' + $(this).data('date'));
            $('#url').attr('src', $(this).data('url'));
            $('#exampleModalLabel').html($(this).data('title'));
            $('#text').html($(this).data('text'));
            $('#addComment').data('id',$(this).data('id'));
            let html='';
            $.each($(this).data('comments'),function (key,el) {
                let date=new Date(el.create);
                date=char(date.getHours())+':'+char(date.getMinutes())+' '+char(date.getDate())+'/'+char(date.getMonth())+'/'+date.getFullYear();
                html+='<div class="toast" style="opacity: 1"><div class="toast-header"><strong class="me-auto">'+el.auth+'</strong><small>'+date+'</small></div><div class="toast-body">'+el.text+'</div></div>'
            });
            $('#comment').html(html==''?'Коментариев не обнаруженно':html);

            new bootstrap.Modal($('#addSpectacle')).show();
        });
    </script>
@endsection