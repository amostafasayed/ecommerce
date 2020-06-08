@if(session('message'))
    <div class="flash-message">
        @if(session('type')=='success')
            <div class="alert alert-success" role="alert" id="successMessage">
                @else
                    <div class="alert alert-danger" role="alert" id="successMessage">
                        @endif
                        <div style="align-items: center">
                            <h4 class="alert-heading w-capitalize">{{session('type')}} !</h4>
                            <p class="w-capitalize">{{session('message')}}</p>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            </div>
    </div>
@endif

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('/admin/dashboard')}}">
            <img src="/images/logo-admin.png" alt="" class="brand-logo">
        </a>
    </div>
    <!-- /.navbar-header -->


    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div style="margin-top:10px;">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Change Password</a>
                </li>
{{--                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
{{--                </li>--}}
                <li class="divider"></li>
                <li>
                    <a class="d-block" href="{{ url('/admin/logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i>Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <a class="site-link" href="{{url('/')}}" style="color: #ff9a05">Visit Site</a>
    <!-- /.navbar-top-links -->
    @include('admin.includes.side-bar')
</nav>