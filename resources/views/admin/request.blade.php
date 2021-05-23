@extends('admin.layouts')
@section('body')

    <div class="container">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тип</th>
                <th scope="col">Зовут</th>
                <th scope="col">Телефон</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <th scope="row">{{$request->id}}</th>
                    <td>{{$request->type}}</td>
                    <td>{{$request->fio}}</td>
                    <td>{{$request->phone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pb-3">
            {{$requests->onEachSide(1)->links()}}
        </div>
    </div>

@endsection
@section('script')

@endsection
