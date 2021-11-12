

@extends('layouts.admin')

@section('title')
  <title>Setting</title>
@endsection

@section('content')
 
@section('css')
  <link rel="stylesheet" href="{{asset('admins\setting\index\index.css')}}">
@endsection

@section('js')
  <script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>
  <script src="{{asset('admins/main.js')}}"></script>
@endsection

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'setting','key' => 'List'])
    

    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group float-right">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    Add setting
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{route('setting.create').'?type=Text'}}">Text</a></li>
                    <li><a href="{{route('setting.create').'?type=Textarea'}}">Textarea</a></li>
                  </ul>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Config key</th>
                      <th scope="col">Config value</th>
                      <th scope="col-2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($settings as $setting)
                    <tr>
                      <th scope="row">{{$setting -> id}}</th>
                      <td>{{$setting -> config_key}}</td>
                      <td>{{$setting -> config_value}}</td>
                      <td><a href="{{route('setting.edit',['id' => $setting->id])}}" class="btn btn-default">Sửa</a></td>
                      <td><a data-url="{{route('setting.delete',['id' => $setting->id])}}" class="btn btn-default action_delete">Xóa</a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
            <div class="col-md-12">
              {{$settings->links('pagination::bootstrap-4')}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


