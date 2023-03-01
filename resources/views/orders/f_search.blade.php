@extends('layouts.app')

{{-- Aqui personalizo el stylo con un script que import con el YIELD que coloque en el layout --}}

@section('css')
  <link href="{{ asset('css/tabs.css') }}" rel="stylesheet">
@endsection

@section('content')

  <div class="wk-page-container-fluid">
    <div class="row">
      <div class="wk-page-container-fluid">

        <!-- ......................................................................... -->
        <!--                MAIN FORM                                                  -->
        <!-- ......................................................................... -->

        <div  class="wk-col-9" style="background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px; margin-left: 15%;">

              <form class="" action="{{ route('submit') }}" method="post">
                  <input type="hidden" name="_token"value="{{{ csrf_token() }}}"/>
                  <input type="hidden" name="group"value="{{$group}}"/>

                  <!-- ..................................-->
                  <!--        NEW OPTIONS FOR AGENT    -->
                  <!-- ..................................-->
                  <!--Aqui comenzamos a añadir costumization que queremos exportar al lado del cliente-->
                  <div class="wk-row " style="padding-top: 40px;">
                    <div class="wk-notification wk-is-open wk-notification-success" role="alert">
                      <span class="wk-icon-filled-check-circle" aria-hidden="true" style="font-size: 1.75rem; top: 1.5rem;"></span>
                      <p class="wk-notification-content" style="font-size: 1.75rem;">
                        <b>{{$group}}</b>
                      </p>

                    </div>

                    <div class="wk-notification wk-is-open wk-notification-warning" role="alert">
                      <span class="wk-icon-filled-alert" aria-hidden="true" style="font-size: 1.75rem; top: 1.5rem;"></span>
                      <p class="wk-notification-content" style="font-size: 1.75rem;">
                        <b>Please select the products to build the jumpstart:</b>
                      </p>
                    </div>
                  </div>
                  <!-- .............. ROW 1 ......................... -->
                  <div class="wk-row product" style="padding-top: 40px;">

        <!-- ....... CARD 1 ........... -->
                    <div class="wk-col-5" style="padding: 0px 10px">
                        <div class="wk-row">
                          <div class="wk-col-12" style="background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">

                            @if(count($journals)>=1)
                              <div class="form-check">
                                <div class="wk-row">
                                  <div class="wk-col-6">
                                    <input class="form-check-input" type="checkbox" name = "journal" value="journal" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        <p>Journals</p>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            @else
                            <div class="wk-notification wk-is-open wk-notification-error" role="alert">
                              <span class="wk-icon-filled-stop-sign"style="font-size: 1.25rem;" aria-hidden="true"></span>
                              <p class="wk-notification-title" style="font-size: 1.25rem;">This customer doesn't have journals</p>
                            </div>
                            @endif

                            @if(count($books)>=1)
                            <div class="form-check">
                              <div class="wk-row">
                                <div class="wk-col-6">
                                  <input class="form-check-input" type="checkbox" name = "book" value="book" checked>
                                  <label class="form-check-label" for="flexCheckChecked">
                                      <p>Books</p>
                                  </label>
                                </div>
                              </div>
                            </div>
                            @else
                              <div class="wk-notification wk-is-open wk-notification-error" role="alert">
                                  <span class="wk-icon-filled-stop-sign"style="font-size: 1.25rem;" aria-hidden="true"></span>
                                  <p class="wk-notification-title" style="font-size: 1.25rem;">This customer doesn't have books</p>
                              </div>
                            @endif
                          </div>
                        </div>

                        <!------------------- DATABASES --------------->
                        <!-- Puse toda la parte de databases junta -->
                        <div class="wk-row">
                          <div class="wk-col-12"  style="padding-top: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
                              @include('layouts.dashboard.databases')
                          </div>
                        </div>
                    </div>

        <!-- ....... CARD 2 ........... -->

                    <div class="wk-col-3" style="background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
                        <!-- ....... SILVER CHAIR ........... -->
                        <div class="wk-row">
                          <div class="wk-col-12">
                            @include('layouts.dashboard.silver_chair')
                          </div>
                        </div>
                        <!-- ....... ATYPON ........... -->
                        <div class="wk-row">
                          <div class="wk-col-12">
                          @include('layouts.dashboard.atypon')
                          </div>
                        </div>

                        <!-- ....... HIGH WIRE ........... -->
                        <div class="wk-row">
                          <div class="wk-col-12">
                          @include('layouts.dashboard.high_wire')
                          </div>
                        </div>

                      <!-- ....... MORE PRODUCTS ........... -->
                        <div class="wk-row">
                        <div class="wk-col-12">
                        @include('layouts.dashboard.more_products')
                        </div>
                      </div>
                    </div>

        <!-- ....... CARD 3 ........... -->
                    <!-- ....... ACCESS ........... -->
                    <div class="wk-col-4" style="background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
                        @include('layouts.dashboard.access')

                    </div>
                    </div>
                    </br>


                  <button type="submit" class="btn btn-success wk-size-8 wk-weight-500">
                    <span class="">NEXT</span>
                  </button>
              </form>
      </div>


    </div>
  </div>
</div>
@endsection
