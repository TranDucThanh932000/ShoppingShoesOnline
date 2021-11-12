

@extends('layouts.admin')

@section('title')
  <title>Setting</title>
@endsection

@section('content')

  <div class="content-wrapper">
    
    @include('partials.content-header',['name' => 'setting','key' => 'Add'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('setting.store') . '?type=' . request()->type }}" method='POST'>
               @csrf
                 <div class="form-group">
                   <label for="exampleInputEmail1">Config key</label>
                   <input type="text" name="config_key" class="form-control" placeholder="Nhập config key">
                   @error('config_key')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                 @if(request()->type === 'Text')
                 <div class="form-group">
                   <label for="exampleInputEmail1">Config value</label>
                   <input type="text" name="config_value" class="form-control" placeholder="Nhập config value">
                   @error('config_value')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                 </div>
                 @elseif(request()->type === 'Textarea')
                 <div class="form-group">
                   <label for="exampleInputEmail1">Config value</label>
                   <textarea type="text" class="form-control" name="config_value" placeholder="Nhập config value"  rows="4"></textarea>
                 </div>
                 @endif
                 <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
        </div>
        
      </div>
    </div>
    
  </div>
  
@endsection


