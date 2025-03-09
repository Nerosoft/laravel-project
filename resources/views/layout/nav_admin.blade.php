<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{$lang->label2}}</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.logout')}}">{{$lang->label1}}</a>
      </li>
    </ul>
    <div class="dropdown">
  <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    {{$lang->selectBox3}}
  </a>

  <ul class="dropdown-menu">
    <li><a class="dropdown-item {{$lang->active1 ? 'active' : ''}}" href="{{ route('branchMain', $lang->id1) }}">{{$lang->selectBox4}}</a></li>
    @foreach($lang->MyBranch as $index=>$branch)
    <li><a class="dropdown-item {{$lang->id2 === $branch->getId()? 'active' : ''}}" href="{{ route('branchMain', $branch->getId()) }}">{{$branch->getName()}}</a></li>
    @endforeach
   
  </ul>
</div>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">{{$lang->title101}}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            @foreach ($lang->myMenuApp as $item)
                @if(isset($item['items']))
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{isset($item['active']) ? $item['active'] : ''}}"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- item -->
                <i class="{{ $item['icon'] }} {{isset($item['active']) ? $item['active'] : ''}}" style="font-size: 1.3rem; color: cornflowerblue;"></i>
                {{$item['name']}}
                </a>
                <!-- use javascript to handel click event and check if route === my route cansel event else go to route -->
                <ul class="dropdown-menu dropdown-menu-dark">
                @foreach ($item['items'] as $myItem)
                <li><a class="dropdown-item"
                 href="{{isset($myItem['id']) ? route($myItem['link'], isset($myItem['lang']) ? ['lang'=>$myItem['lang'], 'id'=>$myItem['id']] : $myItem['id']) : route($myItem['link'])}}">
                 <!-- sup menu -->
                 <i class="{{ $myItem['icon'] }} {{ isset($myItem['active']) ? $myItem['active'] : '' }}" style="font-size: 1rem; color: cornflowerblue;"></i>
                 <test class="{{ isset($myItem['active']) ? $myItem['active'] : '' }}">{{$myItem['name']}}</test>
                </a></li>
                @endforeach
                </ul>
                </li>
                @else                
                <li class="nav-item">
                  <!-- item menu -->
                  <a class="nav-link {{ isset($item['active']) ? $item['active'] :'' }}" aria-current="page" href="{{ isset($item['id']) ? route($item['link'], $item['id']) : route($item['link']) }}">
                  <i class="{{ $item['icon'] }} {{ isset($item['active']) ? $item['active'] :'' }}" style="font-size: 1.3rem; color: cornflowerblue;"></i>
                  {{ $item['name'] }}
                  </a>
                </li>
                @endif
            @endforeach   
        </ul>
      </div>
    </div>
  </div>
</nav>