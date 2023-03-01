@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>新規ユーザー登録</h1>
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="user">ユーザー名</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="らんてくん">
            </div>
            <div class="form-group">
                <label for="body">年齢</label>
                <input type="number" name="age" class="form-control" value="{{old('age')}}" placeholder="25">
            </div>
            <input type="submit" value="登録" class="btn btn-primary">
        </form>
    </div>
@stop
