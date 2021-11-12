

@extends('layouts.admin')

@section('title')
  <title>Home page</title>
@endsection

@section('css')
    <link rel = "stylesheet" href="{{asset('admins\role\add\add.css')}}">
@endsection

@section('js')
    <script src="{{asset('admins\role\add\add.js')}}"></script>
@endsection

@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'Roles','key' => 'Edit'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <form action="{{route('roles.update',['id' => $role->id])}}" method='POST' enctype='multipart/form-data' style="width:100%;">
            <div class="col-md-12">
               
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên vai trò</label>
                   <input type="text" name="name" value="{{$role->name}}" class="form-control" placeholder="Nhập vai trò">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Mô tả vai trò</label>
                   <textarea name="display_name" class="form-control"   rows="4">{{$role->display_name}}</textarea>
                 </div>
                 
            </div>
            <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                      <label>
                        <input type="checkbox" class = "checkall">Check all
                      </label>
                    </div>
                    @foreach($permissionsParent as $permissionsParentItem)
                    <div class="card border-primary mb-3 col-md-12">
                        <div class="card-header" >
                            <label>
                                <input type="checkbox" value="" class="checkbox_wrapper">
                            </label>
                            Module {{$permissionsParentItem->name}}
                        </div>
                        <div class="row">
                        @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                            <div class="card-body text-primary col-md-3">
                                <h5 class="card-title">
                                <label>
                                    <input {{ $permissionsChecked->contains('id',$permissionsChildrentItem->id) ? 'checked':''}} type="checkbox" name="permission_id[]" class="checkbox_childrent" value="{{$permissionsChildrentItem->id}}">
                                </label>
                                {{$permissionsChildrentItem->name}}
                                </h5>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endforeach   
                </div>


            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
      </div>
    </div>
    
  </div>
  
@endsection


