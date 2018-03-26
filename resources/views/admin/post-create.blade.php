@extends('claws::admin.layout')

@section('content')
    <div class="content-wrapper">
    <post-create-edit :mount-p="{{$post->toJSON()}}" :mount-t="{{json_encode($type)}}" :mount-m="{}">
        <template slot-scope="props">
            @foreach ($type->meta as $singleType)
                <?php include config('claws.admin_templates') . "/" . $singleType['template']; ?>
            @endforeach
        </template>
    </post-create-edit>
    </div>
@endsection
