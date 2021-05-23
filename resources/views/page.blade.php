@extends('layouts')
@section('body')
    <section class="container d-flex flex-column justify-content-center align-items-center mb-5" style="margin-top: 60px">
        <div class="card w-75 mb-2">
            <img
                    src="{{$spectacle->url}}"
                    class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$spectacle->title}}</h5>
                <hr class="w-100">
                <p class="card-text">{{$spectacle->text}}</p>
            </div>
            <div class="card-footer text-muted">
                Созданно {{$spectacle->created_at->format('H:i d/m/Y')}}</div>
        </div>
        <div class="card w-75">
            <div class="card-body">
                <h5 class="card-title">Коментарии</h5>
                <hr class="w-100">
                <div id="comment" class="row p-2">
                    @if($spectacle->comments)
                        @foreach($spectacle->comments as $comment)
                            <div class="col-auto toast m-1" style="opacity: 1">
                                <div class="toast-header"><strong
                                            class="me-auto">{{$comment->auth}}</strong><small>{{$comment->create->format('H:i d/m/Y')}}</small>
                                </div>
                                <div class="toast-body">{{$comment->text}}</div>
                            </div>
                        @endforeach
                    @else
                        Коментариев не обнаруженно
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <form class="container">
                    <div>
                        <label for="exampleFormControlInput1" class="form-label">Автор</label>
                        <input type="text" class="form-control" id="authComment" required>
                    </div>
                    <div class="mb-1">
                        <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
                        <textarea class="form-control" id="textComment" rows="3" required></textarea>
                    </div>
                    <div class="btn btn-success" id="addComment" data-id="{{$spectacle->id}}">Добавить</div>
                </form>
            </div>
        </div>
    </section>
    {{--    <div class="modal fade" id="addSpectacle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"--}}
    {{--         data-edit="false">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="exampleModalLabel">Спектакль</h5>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body d-flex align-items-center flex-column">--}}
    {{--                    <img src="" id="url" alt="" style="border-radius: 4px">--}}
    {{--                    <hr class="w-75 m-2">--}}
    {{--                    <div id="text" class="mb-3"></div>--}}
    {{--                    <hr class="w-75 m-2">--}}
    {{--                    <div id="comment"></div>--}}
    {{--                    <hr class="w-75 m-2">--}}

    {{--                </div>--}}
    {{--                <div class="modal-footer"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
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
                type: 'POST',
                url: '{{route('comment')}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    auth: $('#authComment').val(),
                    text: $('#textComment').val(),
                    id: $('#addComment').data('id')
                },
                dataType: 'JSON',
                success: (response) => {
                    window.location.reload()
                }
            })
        });
    </script>
@endsection