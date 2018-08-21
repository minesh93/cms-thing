<html>
    <head>
        <title>Claws</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="admin-prefix" content="{{ config('claws.admin_url') }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.2/css/all.css" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <main id="app">
            <div class="sidebar-ting">
                <div class="sidebar-header">
                    <h2>Claws</h2>
                </div>
                <div class="sidebar-list">
                     <ul class="menu-list">
                        <li>
                            <a class="@if(strpos(url()->current(),'/dashboard')) is-active @endif" href="/{{ config('claws.admin_url') }}/dashboard">
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
                                <a class="@if(strpos(url()->current(),$pr->name)) is-active @endif" href="/{{ config('claws.admin_url') }}/content/{{$pr->name}}/">
                                    <i class="fas {{$pr->icon}}"></i> <span>{{$pr->listName}}</span>
                                </a>
                                <ul class="submenu @if(strpos(url()->current(),$pr->name))is-active @endif">
                                    <li><a class="@if(Request::is('admin/content/'.$pr->name)) is-active @endif" href="/{{ config('claws.admin_url') }}/content/{{$pr->name}}/">{{$pr->listTitle}}</a></li>
                                    <li><a class="@if(Request::is('admin/content/'.$pr->name.'/add')) is-active @endif" href="/{{ config('claws.admin_url') }}/content/{{$pr->name}}/add">{{$pr->createText}}</a></li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-list settings">
                    <h3>Configuration</h3>
                    <ul class="menu-list">
                        <li>
                            <a class="is-active" href="/{{ config('claws.admin_url') }}/settings/general">
                                <i class="fas fa-cog"></i> <span>Settings</span>
                            </a>

                            <ul class="submenu is-active">
                                @foreach(SettingsRegister::getSettings() as $settingKey => $setting)
                                    <li>
                                        <a href="/{{ config('claws.admin_url') }}/settings/{{$settingKey}}">{{$setting['name']}}</a>
                                    </li>
                                @endforeach
                            </ul>

                        </li>
                        <li>
                            <a class="@if(strpos(url()->current(),'admin/users'))is-active @endif" href="/{{ config('claws.admin_url') }}/users/">
                                <i class="fas fa-users"></i> <span>Users</span>
                            </a>
                            <ul class="submenu @if(strpos(url()->current(),'admin/users') || strpos(url()->current(),'admin/roles'))is-active @endif">
                                <li>
                                    <a class="@if(Request::is('admin/users')) is-active @endif" href="/{{ config('claws.admin_url') }}/users">All Users</a>
                                </li>
                                <li>
                                    <a class="@if(Request::is('admin/roles')) is-active @endif" href="/{{ config('claws.admin_url') }}/roles">All Roles</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="content-ting">
                <v-notification></v-notification>
                @yield('content')
            </div>
            <v-uploader></v-uploader>
        </main>
        <script type="text/javascript" src="{{ asset('admin/js/app.js') }}"></script>
    </body>
</html>