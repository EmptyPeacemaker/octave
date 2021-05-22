@extends('admin.layouts')
@section('body')
<div class="container">

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Фото</th>
            <th scope="col">Автор</th>
            <th scope="col">Дата добавления</th>
        </tr>
        </thead>
        <tbody>
        @foreach($photos as $photo)
            <tr>
                <th scope="row">{{$photo->id++}}</th>
                <td><img style="height: 80px" src="{{$photo->url}}" alt=""></td>
                <td>{{$photo->user_id}}</td>
                <td>{{$photo->create}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pb-3">
        {{$photos->onEachSide(1)->links()}}
    </div>
    <div class="row justify-content-end">
        <div class="col-auto btn btn-success" data-bs-toggle="modal" data-bs-target="#addPhoto">Добавить фото</div>
    </div>
</div>
<div class="modal fade" id="addPhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="addForm">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление фото</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Выберите фото для загрузки</label>
                    <input class="form-control" type="file" name="photo" id="addPhotoInput" accept="image/*" >
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
    $('#addPhotoInput').change(function (e){
        if (/image.+/i.test($(this)[0].files[0].type) === false){
            alert("Выберите файл фотографии!")
            $(this).val('')
        }
    })
    $('#addForm').submit(function (e){
        e.preventDefault()
        let photo = $('#addPhotoInput')[0].files;
        if (photo.length === 1){
            let formData = new FormData();
            formData.append('photo',photo[0])
            formData.append('_token',"{{ csrf_token() }}")
            $.ajax({
                type:'POST',
                url:'{{route('photo.load')}}',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (response)=>{
                    window.location.reload()
                }
            })
        } else {
            alert("Должна быть выбрана фотография!")
        }
    })
</script>
@endsection
