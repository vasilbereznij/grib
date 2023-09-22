<nav id="w0" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
            <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('selection')}}">Главная</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/about">О сайте</a></li>
                <li class="nav-item"><a class="nav-link" href="/security">Безопасность</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('gribs')}}">Просмотр всех</a></li>
                                
                @if (auth()->check())
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{route('article.page.add')}}">Article Add</a> --}}
                        <a class="nav-link" href="grib/create">Grib Add</a>
                    </li>    
                @endif
            </ul>
            <div class="d-flex">
                @if (auth()->guest())
                    <a href="{{route('login.form')}}" class="m-lg-1">Login</a>
                    <a href="{{route('register.form')}}" class="m-lg-1">Register</a>              
                @else
                    <a href="#" class="m-lg-1">{{ auth()->user()->name }} ({{auth()->user()->email}})</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger"> Logout </button>
                        <button type="submit" class="btn btn-primary"> Sing in </button>     
                    </form>    
                @endif
            </div>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>