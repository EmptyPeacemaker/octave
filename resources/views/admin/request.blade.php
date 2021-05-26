@extends('admin.layouts')
@section('body')

    <div class="container">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тип</th>
                <th scope="col">Имя</th>
                <th scope="col">Телефон</th>
                <th scope="col">Дата подачи</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <th scope="row">{{$request->id}}</th>
                    <td>{{$request->type}}</td>
                    <td>{{$request->fio}}</td>
                    <td>{{$request->phone}}</td>
                    <td>{{$request->create->format('H:i d/m/Y')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pb-3">
            {{$requests->onEachSide(1)->links()}}
        </div>
        <a href="{{route('download')}}" class="btn btn-success">Скачать отчет</a>
    </div>

@endsection
@section('script')

@endsection
