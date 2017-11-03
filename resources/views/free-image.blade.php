@extends('layouts.app') @section('content')

<div class="columns is-centered">

<img class='test-image' src='{{ asset("free.jpg") }}'/>

    <image-editor free='true'></image-editor>
</div>
</div>
@endsection