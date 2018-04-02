@extends('claws::admin.layout')

@section('content')
    <div class="content-wrapper">
        <settings-edit :mount-s="{{json_encode($settings)}}">
            <template slot-scope="props">
                @include(config('claws.admin_settings_templates') . "." . $settings['template'])
            </template>
        </settings-edit>
    </div>
@endsection
