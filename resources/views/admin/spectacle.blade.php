@extends('admin.layouts')
@section('body')


    <div class="container">
        <div class="row">
            <div class="col-auto  p-0 mt-2 ml-3">
                <div class="btn btn-outline-success" style="height: 98%;width: 18rem;height: 350px;"
                     data-bs-toggle="modal"
                     data-bs-target="#addSpectacle">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <span class="material-icons" style="font-size: 90px">add</span>
                    </div>
                </div>

            </div>
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
                            Обновленно {{$spectacle->updated_at->format('H:i d/m/Y')}}</div>
                    </div>
                    <div class="hover-card w-100 h-100 top-0"
                         data-id="{{$spectacle->id}}"
                         data-url="{{$spectacle->url}}"
                         data-title="{{$spectacle->title}}"
                         data-text="{{$spectacle->text}}"
                         data-description="{{$spectacle->description}}"
                         style="position: absolute;border-radius: 0.25em"></div>
                </div>
            @endforeach
        </div>
        <div class="pt-3">
            {{$spectacles->onEachSide(1)->links()}}
        </div>
    </div>

    <div class="modal fade" id="addSpectacle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
         data-edit="false">
        <div class="modal-dialog">
            <form method="POST" action="{{route('spectacle.load')}}" class="modal-content" id="addForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить спектакль</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Выберите фото для загрузки</label>
                        <input class="form-control" type="file" name="photo" id="addPhotoInput"
                               accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" name="title" required placeholder="Заголовок карточки"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Краткое описание</label>
                        <input type="text" class="form-control" name="description" required
                               placeholder="Описание карточки">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
                        <textarea class="form-control" rows="3" required name="text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <span class="material-icons delete btn btn-outline-danger">delete</span>
                </div>
            </form>
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
        $('.modal').on('show.bs.modal',function(){
            $('.modal').data('edit')?$('.delete').show():$('.delete').hide();
        });
        $('.delete').click(function () {
            $.ajax({
                type:'DELETE',
                url:'{{route('spectacle.delete')}}',
                data: {
                    'id':$('.modal').data('id'),
                    '_token': "{{csrf_token()}}"
                },
                dataType: 'JSON',
                success: (response)=>{
                    window.location.reload()
                }
            })
        });
        $('.modal').on('hidden.bs.modal', function (event) {
            $('.modal').data('edit', false);
            $('.modal').data('id', null);
        });
        $('.hover-card').click(function () {
            $('.modal').data('edit', true);
            $('.modal').data('id', $(this).data('id'));
            $.each(['title', 'description', 'text'], (key, el) => {
                $('.modal-body div [name=' + el + '] ').val($(this).data(el))
            });
            new bootstrap.Modal($('#addSpectacle')).show();
        });
        $('#addPhotoInput').change(function (e) {
            if (/image.+/i.test($(this)[0].files[0].type) === false) {
                alert("Выберите файл фотографии!");
                $(this).val('')
            }
        });
        $('#addForm').submit(function (e) {
            e.preventDefault();
            let formData = new FormData();
            if (!$('.modal').data('edit')) {
                if ($('#addPhotoInput')[0].files.length == 0) {
                    alert('Должна быть выбрана фотография!');
                    return;
                }
            } else {
                formData.append('id', $('.modal').data('id'));
            }
            formData.append('photo', $('#addPhotoInput')[0].files[0]);
            formData.append('_token', "{{ csrf_token() }}");
            $.each($(this).serializeArray(), function (key, el) {
                formData.append(el.name, el.value)
            });

            $.ajax({
                type: 'POST',
                url: $('.modal').data('edit') ? '{{route('spectacle.edit')}}' : '{{route('spectacle.load')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    window.location.reload()
                }
            })
        })
    </script>
@endsection
