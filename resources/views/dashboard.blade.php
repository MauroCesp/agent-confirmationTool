@extends('layouts.app')
@section('css')
  <link href="{{ asset('css/tabs.css') }}" rel="stylesheet">
@endsection

@section('content')


        {{-- form class="navbar-form navbar-left" action="action="{{ route("create-password", ["id" => $id])" role="search" --}}
          <div class="wk-row" style="padding-bottom: 100px">
            <div class="wk-col-4"></div>
            <div class="wk-col-3">
              <div style="background-color: #ffffff; border: 1px solid #DCDCDC; padding: 20px">
                <div class="wk-row">
                  <div class="wk-col-12">
                    <h5> Type in the Orion Group:</h5>
                  </div>
                </div>
                <div class="wk-row">
                  <div class="wk-col-12">
                    <form action="{{route('groupSearch')}}" role="search">


                      <div data-field-inlay-items="1" class="wk-field wk-field-extra-large">

                        <div class="wk-field-body">
                            <input type="text" name ="group" id="group" placeholder="" class="wk-field-input" value="" style="font-size: 1.5rem;">
                            <div class="wk-field-inlay">
                                <button type="submit" class="wk-field-button wk-button wk-button-icon wk-button-icon-large">
                                    <span class="wk-icon-search" aria-hidden="true"></span>
                                    <span class="wk-icon-filled-search" aria-hidden="true"></span>
                                    <span class="wk-sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    </form>
    

                  </div>
                </div>


                
      
              
              </div>
            </div>

          </div>
@endsection
