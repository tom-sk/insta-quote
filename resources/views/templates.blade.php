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
                        <a href='/edit-template' class="button is-info is-right">Create New</a>
                    </header>
                   
                   
                   
                    <figure class="image is-128x128">
                        <img @click='backgroundSelect' src={{asset('templates/bar2.jpg')}}>
                    </figure>
                    <div>Edit</div>
                </nav>
            </div>
        </div>
    </div>
@endsection
