<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Database;
use App\Models\SelectData;

class DbController extends Controller
{
  /*
  /-----------------------------------------------------------------------------
  //--------------------   Guardar DB   ---------------------------------  /-----------------------------------------------------------------------------
  */


    // Cunado llamo al metodo de saveVIdeo dentro de la ruta se ejecuta la accion que tenga en ele controlador.
    // Asi recibimos los datos por la request y lo asignamos a la variable $REQUEST
    public function saveDB($response, $ovidGroup){

        //-------- ERRASE DATABASE----------------

        // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
        // Estonces lo que hago es borrala y volverla a escribir.
        // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
        Database::whereNotNull('id')->delete();

              // Esto es todo el objeto JSON
              foreach ($response as $result) {

                // -------- NUEVA CARGA -----------
                // Creo una variable para guarda un objeto nuevo
                $database = new Database();
                  // Recorro cada ELEMENTO del JSON
                  // Dentro de cada elemento voy a tener la info

                  // ---------Escojer db --------------
                  if( $result['productClass'] == 'database'){

                      //--- Asigno variables dentro del objeto VIDEO
                      // Voy metiendo todo lo que me llega por la request dentro de video
                      // Es decir cada uno de estas variables con las que tengo en la base de datos.
                      $database -> cust_group = $ovidGroup;
                      $database -> shortName = $result['shortName'];
                      $database -> orderNumber = $result['orderNumber'];
                      $database -> vendor = $result['vendor'];

                      $database -> formatShortName = $result['formatShortName'];
                      $database -> productClass = $result['productClass'];
                      $database -> jumpStart = $result['jumpStart'];

                      // Esto lo hago con la variables que pueden venir o no. Evito que me de problemas a la hora de insertar en la base de datos
                      if(isset($result['title'])){
                          $database -> title = $result['title'];
                      }

                      if(isset($result['publisher'])){
                          $database -> publisher = $result['publisher'];
                      }

                      $database-> save();

                    }

                  }
          // Asi es como se gurada un video en la base de datos
        }


    public function selectDB(Request $request){

          //-------- ERRASE DATABASE----------------

          // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
          // Estonces lo que hago es borrala y volverla a escribir.
          // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
          SelectData::whereNotNull('id')->delete();


          $arrayAll = $request->all();

          //saco el numero de elementos
          $longitud = count($arrayAll['database']);

          $group = $request->input('group');
          $order = $request->input('order');

          foreach (range(0, $longitud-1) as $i) {
              // -------- NUEVA CARGA -----------
              // Creo una variable para guarda un objeto nuevo
              $database = new SelectData();

              //--- Asigno variables dentro del objeto VIDEO
              // Voy metiendo todo lo que me llega por la request dentro de video
              // Es decir cada uno de estas variables con las que tengo en la base de datos.
              $database -> selection_id = $arrayAll['database'][$i];
              $database -> type = 'database';

              // Como recibo la request con los parametros del formulario
              // YA puedo llamar los INPUTS del formulario con el NAME y ID desde la request
              $database -> groups = $request->input('group');
              $database ->  orders = $request->input('order');

              $database-> save();
            }

            // Este es la forma en que envio un a alert al mismo
            // Tambien le paso parametros con WITH y los llamo con SESSION en la vista
            return redirect()->back()->with('message', $longitud.' DB items have been added to your selection.' )->with('longitudDB',$longitud);
    }

 }
