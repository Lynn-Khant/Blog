<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a
            class="navbar-brand"
            href="/"
        >Creative Coder</a>
        <div class="d-flex">
            
            <a
                href="#home"
                class="nav-link"
            >Home</a>
            @can('isAdmin')
            <a
                href="/admin/blogs"
                class="nav-link"
            >Dashboard</a>
            @endcan
            @if(!auth()->check())
            <a
                href="/register"
                class="nav-link"
            >Register</a>
            <a
                href="/login"
                class="nav-link"
            >Login</a>
            @else
            
            <div><img 
                src="{{auth()->user()->avatar}}"
                width="50"
                height="50"
                class="rounded-circle"
                alt=""></div>
            <a
                href="/"
                class="nav-link"
            >{{auth()->user()->name}}</a>
            @endif
            @if(auth()->check())
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" href="" class="nav-link btn btn-link">Logout</button>
            </form>
            @endif
            <a
                href="#blogs"
                class="nav-link"
            >Blogs</a>
            
        </div>
    </div>
</nav>