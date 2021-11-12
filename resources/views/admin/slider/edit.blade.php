

@extends('layouts.admin')

@section('title')
  <title>Home page</title>
@endsection

@section('css')
    <link rel = "stylesheet" href="{{asset('admins\slider\add\add.css')}}">
@endsection

@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'Slider','key' => 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('slider.update',['id' => $slider->id])}}" method='POST' enctype='multipart/form-data'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên slider</label>
                   <input type="text" name="name" value="{{$slider->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên">
                   @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Mô tả</label>
                   <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""  rows="4">{{$slider->description}}</textarea>
                   @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Hình ảnh</label>
                   <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">
                   <div class="col-md-4">
                        <div>
                            <img class = "image_slider" src = "{{$slider->image_path}}">
                        </div>
                   </div>
                   @error('image_path')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
        </div>
        
      </div>
    </div>
    
  </div>
  
@endsection


