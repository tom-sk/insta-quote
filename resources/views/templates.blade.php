@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Templates

                        </p>
                        <a href='/new-template' class="button is-info is-right">Create New</a>
                    </header>
                </nav>
               
                @foreach($userTemplates as $template )
                    <figure class="image is-128x128">
                        <img src={{asset($template->image)}}>
                    </figure>
                    <div>
                        <a href="/edit-template/{{$template->id}}">
                            Edit
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
