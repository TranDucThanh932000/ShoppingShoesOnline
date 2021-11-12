                        <div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{route('home.homepage')}}" class="active">Trang chủ</a></li>
                                @foreach($categoriesLimit as $categoryParent)
								<li class="dropdown"><a href="{{route('category.product',['slug'=>$categoryParent->slug,'id'=>$categoryParent->id])}}">{{$categoryParent->name}}<i class="fa fa-angle-down"></i></a>
                                    @if($categoryParent->categoryChildrent->count())
                                        @include('home.components.child_menu',['categoryParent'=> $categoryParent])
                                    @endif
                                </li>
                                @endforeach 
							</ul>
						</div>