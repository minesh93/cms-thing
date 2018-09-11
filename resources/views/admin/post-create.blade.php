@extends('claws::admin.layout')

@section('content')
    <post-create-edit :mount-p="{{$post->toJSON()}}" :mount-t="{{json_encode($type)}}" :mount-m="{}">
        <template slot-scope="{ post }">
            @foreach ($type->meta as $singleType)
                @if($singleType['template-restriction'])
                    @if($singleType['template-restriction'] == $post->template)
                        @include(config('claws.admin_content_templates') . "." . $singleType['template'])
                    @endif
                @else
                    @include(config('claws.admin_content_templates') . "." . $singleType['template'])
                @endif
            @endforeach
        </template>
    </post-create-edit>
@endsection
