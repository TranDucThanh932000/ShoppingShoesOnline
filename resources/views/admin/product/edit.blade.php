

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
               <form action="{{route('product.update',['id' => $product->id])}}" method='POST' enctype='multipart/form-data'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Tên sản phẩm</label>
                   <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Nhập tên sản phẩm">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Giá sản phẩm</label>
                   <input type="text" name="price" value="{{$product->price}}" class="form-control" required placeholder="Nhập giá sản phẩm">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Ảnh đại diện</label>
                   
                   <input type="file" name="feature_image_path" multiple name="image_path[]" class="form-control-file">
                   <div class="col-md-12">
                        <div class="row mt-4">
                            <img class="ava_item" src="{{$product->feature_image_path}}"/>
                        </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Ảnh chi tiết</label>
                   <input type="file"  multiple name="image_path[]" class="form-control-file">
                   <div class="col-md-12">
                        <div class="row mt-4">
                        @foreach($product->images as $productImageItem)
                            <div class="col-md-3">
                                <img class="image_detail_edit" src="{{$productImageItem->image_path}}"/>
                            </div>
                        @endforeach
                        </div>
                   </div>
                 </div>
                 <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="content"  class="form-control" id="exampleFormControlTextarea1" rows="3">{{$product->content}}"</textarea>
                </div>
                   <div class="form-group">
                     <label>Chọn danh mục</label>
                     <select class="form-control select2_init" name="parent_id">
                       <option value="">Chọn danh mục</option>
                       {{!!$htmlOption!!}}
                     </select>
                   </div>
                   <div class="form-group" >
                     <label>Nhập tags cho sản phẩm</label>
                    <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">
                    @foreach($product->tags as $tagItem)
                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
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

    <script src="{{asset('admins/product/add/add.js')}}">></script>


@endsection


