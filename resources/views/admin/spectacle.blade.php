@extends('admin.layouts')
@section('body')


    <div class="container">
        <div class="row">
            <div class="col-auto">
                <div class="btn btn-outline-success mb-1 mt-1" style="height: 98%;width: 18rem;" data-bs-toggle="modal"
                     data-bs-target="#addSpectacle">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <span class="material-icons" style="font-size: 90px">add</span>
                    </div>
                </div>

            </div>
            @foreach($spectacles as $spectacle)
            <div class="col-auto">
                <div class="card mb-1 mt-1" style="width: 18rem;">
                    <img
                        src="{{$spectacle->url}}"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$spectacle->title}}</h5>
                        <p class="card-text">{{$spectacle->description}}</p>

                    </div>
                    <div class="card-footer text-muted">{{$spectacle->updated_at}}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pb-3">
            {{$photos->onEachSide(1)->links()}}
        </div>
    </div>

    <div class="modal fade" id="addSpectacle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{route('spectacle.load')}}" class="modal-content" id="addForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить спектакль</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Выберите фото для загрузки</label>
                        <input class="form-control" type="file" name="photo" required id="addPhotoInput"
                               accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" name="title" required placeholder="Заголовок карточки"
                               value="Заголовок">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Краткое описание</label>
                        <input type="text" class="form-control" name="description" required
                               placeholder="Описание карточки" value="Краткое описание">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Текст</label>
                        <textarea class="form-control" rows="3" required name="text">Текст</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $('#addPhotoInput').change(function (e) {
            if (/image.+/i.test($(this)[0].files[0].type) === false) {
                alert("Выберите файл фотографии!")
                $(this).val('')
            }
        })
        $('#addForm').submit(function (e) {
            e.preventDefault()
            let formData = new FormData();
            formData.append('photo', $('#addPhotoInput')[0].files[0])
            formData.append('_token',"{{ csrf_token() }}")
            $.each($(this).serializeArray(), function (key, el) {
                formData.append(el.name,el.value)
            })
            $.ajax({
                type: 'POST',
                url: '{{route('spectacle.load')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    // window.location.reload()
                }
                })
        })
    </script>
@endsection
