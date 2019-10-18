<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Claws</h2>
        </div>
        <div class="sidebar-list links">
            <ul class="menu-list">
                <li>
                    <router-link to="/dashboard">
                        <span>Dashboard</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/test">
                        <span>Test</span>
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="sidebar-list posts">
            <h4>Content</h4>
            <ul class="menu-list">
                <li v-for="post in posts" :key="post.type">
                    <router-link :to="`/content/${post.type}`">
                        <span>{{post.name}}</span>
                    </router-link>
                    <!-- <ul class="submenu @if(strpos(url()->current(),$pr->name))is-active @endif">
                        <li><a class="@if(Request::is('admin/content/'.$pr->name)) is-active @endif" href="/content/{{$pr->name}}/">{{$pr->listTitle}}</a></li>
                        <li><a class="@if(Request::is('admin/content/'.$pr->name.'/add')) is-active @endif" href="/content/{{$pr->name}}/add">{{$pr->createText}}</a></li>
                    </ul> -->
                </li>
            </ul>
        </div>

        <div class="sidebar-list settings">
            <h4>Configuration</h4>
            <!-- <ul class="menu-list">
                <li>
                    <a href="/settings/general">
                        <i class="fas fa-cog"></i> <span>Settings</span>
                    </a>

                    <ul class="submenu">
                        @foreach(SettingsRegister::getSettings() as $settingKey => $setting)
                            <li>
                                <a href="/settings/{{$settingKey}}">{{$setting['name']}}</a>
                            </li>
                        @endforeach
                    </ul>

                </li>
                <li>
                    <a class="@if(strpos(url()->current(),'admin/users')) is-active @endif" href="/users/">
                        <i class="fas fa-users"></i> <span>Users</span>
                    </a>
                    <ul class="submenu @if(strpos(url()->current(),'admin/users') || strpos(url()->current(),'admin/roles'))is-active @endif">
                        <li>
                            <a class="@if(Request::is('admin/users')) is-active @endif" href="/users">All Users</a>
                        </li>
                        <li>
                            <a class="@if(Request::is('admin/roles')) is-active @endif" href="/roles">All Roles</a>
                        </li>
                    </ul>
                </li>
            </ul> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'sidebar',
    data() {
        return {
            c: 1
        }
    },

    computed: {
        posts() {
            return this.$store.state.register
        },
    }
}
</script>