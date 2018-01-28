<html>
    <head>
        <title>Claws</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.2/css/all.css" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
    </head>
    <body>
        <main>
            <div class="sidebar-ting">
                <div class="sidebar-header">
                    <h2>Claws</h2>
                </div>
                <div class="sidebar-list">
                     <ul class="menu-list">
                        <li>
                            <a class="@if(strpos(url()->current(),'/dashboard')) is-active @endif" href="/admin/dashboard">
                                <i class="fas fa-columns"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-list posts">
                    <h3>Content</h3>
                    <ul class="menu-list">
                        @foreach(PostRegister::getRegister() as $pr)
                            <li>
                                <a class="@if(strpos(url()->current(),$pr->name)) is-active @endif" href="/admin/content/{{$pr->name}}/">
                                    <i class="fas {{$pr->icon}}"></i> <span>{{$pr->listName}}</span>
                                </a>
                                <ul class="submenu @if(strpos(url()->current(),$pr->name))is-active @endif">
                                    <li><a class="@if(Request::is('admin/content/'.$pr->name)) is-active @endif" href="/admin/content/{{$pr->name}}/">{{$pr->listTitle}}</a></li>
                                    <li><a class="@if(Request::is('admin/content/'.$pr->name.'/add')) is-active @endif" href="/admin/content/{{$pr->name}}/add">{{$pr->createText}}</a></li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-list settings">
                    <h3>Configuration</h3>
                    <ul class="menu-list">
                        <li>
                            <a class="@if(Request::is('admin/settings/general')) is-active @endif" href="/admin/settings/general">
                                <i class="fas fa-cog"></i> <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="@if(strpos(url()->current(),'admin/users'))is-active @endif"" href="/admin/users/">
                                <i class="fas fa-users"></i> <span>Users</span>
                            </a>
                            <ul class="submenu @if(strpos(url()->current(),'admin/users'))is-active @endif">
                                <li>
                                    <a class="@if(Request::is('admin/users')) is-active @endif" href="/admin/settings/general">All Users</a>
                                </li>
                                <li>
                                    <a class="@if(Request::is('admin/roles')) is-active @endif" href="/admin/roles">Roles</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="content-ting">
                @yield('content')
            </div>
        </main>
        <script type="text/javascript" src="{{ asset('admin/js/app.js') }}"></script>
    </body>
</html>