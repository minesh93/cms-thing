@extends('claws::admin.layout-login')

@section('content')
    <div id="login-form-wrap">
        <form method="post">
            <h1>Login</h1>
            <div class="fieldset">
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>
            </div>

            <div class="fieldset">
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
            </div>

            <div class="fieldset">

                {{ csrf_field() }}

                <button class="full-width" type="submit">
                    Login
                </button>
            </div>

        </form>
    </div>
@endsection