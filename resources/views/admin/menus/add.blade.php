

@extends('layouts.admin')

@section('title')
  <title>Home page</title>
@endsection

@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'menus','key' => 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('menus.store')}}" method='POST'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên menu</label>
                   <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
                 </div>
                   <div class="form-group">
                     <label>Chọn danh mục</label>
                     <select class="form-control" name="parent_id">
                       <option value="0">Chọn menu cha</option>
                       {!! $optionSelect !!}
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


