

@extends('layouts.admin')

@section('title')
  <title>Home page</title>
@endsection

@section('content')
 
  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'menus','key' => 'List'])
    

    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('menus.create')}}" class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên menu</th>
                      <th scope="col-2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($menus as $menu)
                    <tr>
                      <th scope="row">{{$menu->id}}</th>
                      <td>{{$menu->name}}</td>
                      <td><a href="{{route('menus.edit',['id' => $menu->id])}}" class="btn btn-default">Sửa</a></td>
                      <td><a href="{{route('menus.delete',['id' => $menu->id])}}" class="btn btn-default">Xóa</a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
            <div class="col-md-12">
              {{ $menus->links('pagination::bootstrap-4')}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


