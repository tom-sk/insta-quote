@extends('layouts.app')

@section('content')

<div class="columns is-centered">
            <image-editor :template="{{$template}}" ></image-editor>
        </div>
    </div>
@endsection
