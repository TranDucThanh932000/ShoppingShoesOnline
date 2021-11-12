

@extends('layouts.admin')

@section('title')
  <title>Add product</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">
@endsection


@section('js')
  <script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>
  <script src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
 
  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'product','key' => 'List'])
    

    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            @can('product-add')
                <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
            @endcan
            </div>
            <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Hình ảnh</th>
                      <th scope="col">Danh mục</th>
                      <th scope="col-2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)  
                    <tr>
                      <th scope="row">{{$product->id}}</th>
                      <td>{{$product->name}}</td>
                      <td>{{number_format($product->price)}}</td>
                      <td>
                        <img class="imageList" src="{{$product->feature_image_path}}"/>
                      </td>
                      <td>{{optional($product->category)->name}}</td>
                      
                      <td>@can('product-edit',$product->id)<a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-default">Sửa</a>@endcan</td>
                      <td>@can('product-delete',$product->id)<a class="btn btn-danger action_delete" data-url="{{route('product.delete',['id'=>$product->id])}}" href="" class="btn btn-default">Xóa</a>@endcan</td>
                    </tr>
                  @endforeach 
                  </tbody>
                </table>
            </div>
            <div class="col-md-12">
               {{$products->links('pagination::bootstrap-4')}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


