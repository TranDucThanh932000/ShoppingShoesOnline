

@extends('layouts.admin')

@section('title')
  <title>Add product</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet" />
@endsection



@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'product','key' => 'Add'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('product.store')}}" method='POST' enctype='multipart/form-data'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên sản phẩm</label>
                   <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                   @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Giá sản phẩm</label>
                   <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price')}}" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                   @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Ảnh đại diện</label>
                   <input type="file" name="feature_image_path" class="form-control-file">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Ảnh chi tiết</label>
                   <input type="file"  multiple name="image_path[]" class="form-control-file">
                 </div>
                 <div class="form-group">
                   <label>Size</label>
                   <select multiple name="sizes[]" id="" class="form-control">
                     @for($i = 30;$i <= 44; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                     @endfor
                   </select>
                 </div>
                 <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                   <div class="form-group">
                     <label>Chọn danh mục</label>
                     <select class="form-control select2_init @error('parent_id') is-invalid @enderror"  name="parent_id">
                       <option value="">Chọn danh mục</option>
                       {{!! $htmlOption !!}}
                     </select>
                     @error('parent_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                   </div>
                   <div class="form-group" >
                     <label>Nhập tags cho sản phẩm</label>
                    <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">

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

    <script src="{{asset('admins/product/add/add.js')}}"></script>


@endsection


