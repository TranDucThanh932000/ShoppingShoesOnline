

@extends('layouts.admin')

@section('title')
  <title>Home page</title>
@endsection

@section('css')
  <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admins\user\add\add.css')}}" rel="stylesheet" />
@endsection

@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'User','key' => 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('users.store')}}" method='POST' enctype='multipart/form-data'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên</label>
                   <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Email</label>
                   <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Mật khẩu</label>
                   <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Chọn vai trò</label>
                   <select class="form-control select2_init" name="role_id[]" multiple>
                      @foreach($roles as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                   </select>
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
        </div>
        
      </div>
    </div>
    
  </div>
  
@endsection

@section('js')
  <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
  <script src="{{asset('admins\user\add\add.js')}}"></script>
@endsection
