@extends('layouts.app')


@section('css')
  <link href="{{ asset('css/tabs.css') }}" rel="stylesheet">
@endsection

@section('content')

  <div class="container">
    <div class="row">


      <div class="container">
<!-- Primera alerta   -->

          <div class="alert alert-warning">
              <p><b>The following information will be use to build the jumpstart:</b></p>
          </div>

          <!-- Creo una serie de divs para mostrar la informacion que va a ser enviada al cliente -->
          <div class="wk-row">
            <!----------------------------------------->
            <div class="wk-col-2">
              <div class="alert alert-success">
                  <!-- Primero creo un array para guardar las opciones que se seleccionan -->
                  <?php $emptyArray = [];?>
                  {{-- ---------------------JOURNALS---------------------------------- --}}
                  <!-- Ahora valido los parametros que me llegan desde el controlador -->
                  @if ($journal == 'journal')
                    <?php $array[] = 'j';?>
                    <p><b>Journals </b></p>
                  @endif
                  {{-- ---------------------BOOKS---------------------------------- --}}
                  @if ($book == 'book')
                    <?php $array[] = 'b';?>
                    <p><b>Books </b></p>
                  @endif

                  {{-- ---------------------DB---------------------------------- --}}
                  @if ($database == 'database')
                    <?php $array[] = 'd';?>
                    <p><b>Databases </b></p>
                  @endif
              </div>
            </div>
            <!----------------------------------------->
            <div class="wk-col-2">
              <!-- Primero creo un array para guardar las bases de datos que deseo enviar al cliente -->
              <?php $dbArray = [];?>
              @foreach ($categories as $item)
                <?php $dbArray[] = $item;?>
              @endforeach
              <!-- -------------------------------------- -->
              <!--      COSTRUCCION DEL JUMPSTART         -->
              <!-- -------------------------------------- -->
              <!-- SOlo me aparece la alert si existen bases de datos -->
              @if ($database == 'database')
                <div class="alert alert-danger">
                  <!-- Primero inicializo otro array para guardar los valores identificados para enviar -->
                  <?php $final_array = array();?>
                  <!-- Recorro el array que cree para los productos y lo añado a la ruta -->
                  @foreach ($dbArray as $i)
                    @foreach ($query as $q)
                      @if ($q == $i)

                        <?php $final_array[]= $i ?>
                      @endif
                    @endforeach
                  @endforeach

                  @foreach ($query as $q)
                    @foreach($list_names_dbs as $key =>$p)
                        @if($key == $q)
                          <p>{{$list_names_dbs[$q]}}</p>
                        @endif
                    @endforeach
                  @endforeach
                </div>
              @endif
              <!-- Recorro el array bucando los valores que quiero enviar al cliente -->

              <!-- Creo un string para poder unir todas las variables en una solo y enviar un solo parametro. -->
              <?php $dbs= " " ?>

              <!-- Recorro el array que cree para los productos y lo añado a la ruta -->
              @foreach ($final_array as $i)

              <?php

                      switch($i) {
                          case 'ovftdb':
                              $i = 1;
                          break;

                          case 'emcadb':
                              $i = 2;
                          break;

                          case 'ericdb':
                              $i = 3;
                          break;

                          case 'embase':
                              $i = 4;
                          break;

                          case 'medline':
                              $i = 5;
                          break;

                          case 'ebmr':
                              $i = 6;
                          break;

                          case 'jbindb':
                              $i = 7;
                          break;

                          case 'MWIC':
                              $i = 8;
                          break;

                          case 'psycdb':
                              $i = 9;
                          break;

                          case 'booksall':
                              $i = 10;
                          break;

                          case 'ebmr':
                              $i = 11;
                          break;

                          case 'ameddb':
                              $i = 12;
                          break;

                          default:
                              $i = '';

                      }
              ?>
                <!-- Esta es la forma en que PHP adjunta texto
                    Creo un solo string con todas la s variables que voy a descomponer del lado del cliente.-->
                <?php $dbs .= $i ?>

                <!-- Agrego un dash para poder dividir los numeros del otro lado -->
                <?php $dbs .= ':' ?>
              @endforeach
            </div>
            <!----------------------------------------->
           @if($list_silver_chair >0)
            <!-- Creo un string para poder unir todas las variables en una solo y enviar un solo parametro. -->
            <?php $silver_chair= "" ?>

              <div class="wk-col-2">
                @foreach($list_silver_chair as $i)
                  <p>{{$i}}</p>
                  <!-- Esta es la forma en que PHP adjunta texto
                      Creo un solo string con todas la s variables que voy a descomponer del lado del cliente.-->
                  <?php
                  // Le digo que quiero que me saque la ultima silaba de la palabra
                  // Es lo que en vio por parametro
                  $rest = $i[0];
                  $silver_chair .= $rest ?>
                  <!-- Agrego un dash para poder dividir los numeros del otro lado -->
                  <?php $silver_chair .= ':' ?>
                @endforeach
              </div>
            @else
              <?php $silver_chair= "#" ?>
            @endif

            <!----------------------------------------->
            <!----------------------------------------->
            @if($list_access >0)
            <!-- Creo un string para poder unir todas las variables en una solo y enviar un solo parametro. -->
            <?php $access= "" ?>

              <div class="wk-col-2">
                @foreach($list_access as $i)
                  <p>{{$i}}</p>
                  <?php
                  // Le digo que quiero que me saque la ultima silaba de la palabra
                  // Es lo que en vio por parametro
                  $x = $i[0];
                  $access .= $x ?>
                  <!-- Agrego un dash para poder dividir los numeros del otro lado -->
                  @if($i =='openAthens')
                    <?php $access .= ':' ?>
                    <?php $access .= $entityID ?>
                  @endif
                  <?php $access .= ':' ?>
                @endforeach
              </div>
            @else
                <?php $access= "#" ?>
            @endif
            <!----------------------------------------->

            <!----------------------------------------->
            @if($list_atypon >0)
            <!-- Creo un string para poder unir todas las variables en una solo y enviar un solo parametro. -->
            <?php $atypon= "" ?>

              <div class="wk-col-2">
                @foreach($list_atypon as $i)
                  <p>{{$i}}</p>
                  <?php
                  // En el caso de ATYPON es la segunda letra la que cambia
                  // La cojemos y la enviamos por parametro
                  $x = $i[1];
                  $atypon .= $x ?>
                  <?php $atypon .= ':' ?>
                @endforeach
              </div>
            @else
                  <?php $atypon= "#" ?>
            @endif
            <!----------------------------------------->
            @if($neurology == 'neurology')
              <div class="wk-col-2">
                <p>{{$neurology}}</p>
                <?php $neurology='.' ?>
              </div>
            @else
              <?php $neurology= ".." ?>
            @endif
            <!----------------------------------------->

            <!----------------------------------------->
        </div>

      <!-- Ahora creo un BASE URL que es la ruta para el ptro projecto laravel + GROUP -->
      <?php $a = strval("10.233.8.25/index.php?group=$group&products=") ?>

      <!-- Creo un string para poder unir todas las variables en una solo y enviar un solo parametro. -->
      <?php $param0= "" ?>
      <!-- Recorro el array que cree para los productos y lo añado a la ruta -->
      @foreach ($array as $item)
        <!-- Esta es la forma en que PHP adjunta texto
            Creo un solo string con todas la s variables que voy a descomponer del lado del cliente.-->
        <?php $param0 .= $item ?>
      @endforeach

      <!-- Ahora uno esta parate al string que ya tenia -->
      <?php $a .= $param0 ?>

      <!-- AQUI ES DONDE SE PUEDEN AGREGAR PARAMETROS -->
      <!-- Ahora creo el input que envio por la request con el FORM, ya la ruta está construida -->

      <input type="text" value="{{$a}}&dbs={{$dbs}}&silver_chair={{$silver_chair}}&access={{$access}}&atypon={{$atypon}}&neurology={{$neurology}}" id="myInput">

<!-- Fuera de la alerta   -->
      <!-- Esto es solo un btn para copiarlo con JS -->
      <button onclick="myFunction()">Copy text</button>


      </body>
      </html>

    </div>
  </div>
@endsection
