
<form action="{{route('testapi')}}" method="POST" enctype='multipart/form-data'>
@csrf
  <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="text" name="content" class="form-control-file" id="">
    <input type="file" multiple="multiple" name="raw_image" class="form-control-file" id="">
    
  </div>
  <div>
    <button type="submit" class="btn btn-primary mb-2">Confirm</button>
  </div>
</form>

@foreach($posts as $post)
<div class="item card p-0 mb-5">
    <div class="card-body p-2">
        <h5 class="card-title m-1">{{ $post['content'] }}</h5>
    </div>
    <img class="card-img-bottom" src="{{ $post['image'] }}">
</div>
@endforeach