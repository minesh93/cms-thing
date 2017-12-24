<html>
    <head>
        <title>Claws</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.2/css/all.css" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <main>
            <div class="sidebar-ting">
                <div class="sidebar-header">
                    <h2>Claws</h2>
                </div>
                <div class="sidebar-list posts">
                <ul class="menu-list">
                    @foreach(PostRegister::getRegister() as $pr)
                        <li>
                            <a class="@if(strpos(url()->current(),$pr->name)) is-active @endif" href="/admin/content/{{$pr->name}}/">{{$pr->listName}}</a>
                            <ul class="submenu @if(strpos(url()->current(),$pr->name))is-active @endif">
                                <li><a class="@if(Request::is('admin/content/'.$pr->name)) is-active @endif" href="/admin/content/{{$pr->name}}/">{{$pr->listTitle}}</a></li>
                                <li><a class="@if(Request::is('admin/content/'.$pr->name.'/add')) is-active @endif" href="/admin/content/{{$pr->name}}/add">{{$pr->createText}}</a></li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
            </div>
            <div class="content-ting">
                @yield('content')
            </div>
        </main>
    </body>
</html>