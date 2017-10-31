@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-12">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                           Order
                        </p>
                    </header>
                </nav>
            </div>
        </div>
        <div class="columns is- is-marginless is-centered">
            <div class="column is-12">
                <div class='columns'>
                    <div class='column is-6'>
                        <div>
                            Make and order!
                            <order-select></order-select>
                        </div>
                    </div>

                    <div class='column is-6'>
                        Select
                        <order-amount></order-amount>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
