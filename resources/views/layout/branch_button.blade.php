<div class="dropdown">
        <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{$lang->selectBox3}}
        </a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item {{request()->session()->get('userId') === request()->session()->get('userLogout') ? 'active' : ''}}" href="{{ route('branchMain', request()->session()->get('userLogout')) }}">{{$lang->selectBox4}}</a></li>
        @foreach($lang->MyBranch as $keyBranch=>$branch)
        <li><a class="dropdown-item {{request()->session()->get('userId') === $keyBranch? 'active' : ''}}" href="{{ route('branchMain', $keyBranch) }}">{{$branch->getName()}}</a></li>
        @endforeach
        </ul>
</div>