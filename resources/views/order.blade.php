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
                        <div >
                                Make and order!
        
                                <div class='field'>
                                    <label  class="label">Theme</label>
                                    <div class="field has-addons">
                                
                                        <p class="control">
                                            <button class="button"  value='overlay'>
                                                Motivation
                                            </button>
                                        </p>
                                        <p class="control">
                                            <button class="button" value='border'>
                                                Love
                                            </button> 
                                        </p>
                                        <p class="control">
                                            <button class="button" value='bars'>
                                                Travel
                                            </button>
                                        </p>
                                        <p class="control">
                                            <button class="button" value='none'>
                                                Fashion
                                            </button>
                                        </p>
                                
                                    </div>
                                </div>
        
                                <div class='field'>
                                    <label  class="label">Format</label>
                                    <div class="field has-addons">
                                
                                        <p class="control">
                                            <button class="button"  value='overlay'>
                                                JPEG Animation
                                            </button>
                                        </p>
                                        <p class="control">
                                            <button class="button" value='border'>
                                                Gif Animation
                                            </button> 
                                        </p>
                                        <p class="control">
                                            <button class="button" value='bars'>
                                                MP4 Animation
                                            </button>
                                        </p>
                                    </div>
                                </div>
        
                                <div class='field size-buttons'>
                                    <label  class="label">Size</label>
                                    <div class="field has-addons">
                                
                                        <p class="control">
                                            <button class="button"  value='overlay'>
                                                Instagram<br> 1080x1080
                                            </button>
                                        </p>
                                        <p class="control">
                                            <button class="button" value='border'>
                                                Facebook <br>1080x1080
                                            </button> 
                                        </p>
                                        <p class="control">
                                            <button class="button" value='bars'>
                                                Pintrest <br> 735x735
                                            </button>
                                        </p>
                                        <p class="control">
                                            <button class="button" value='none'>
                                                Twitter <br>1024x512
                                            </button>
                                        </p>
                                
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class='column is-6'>
                        hey
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
