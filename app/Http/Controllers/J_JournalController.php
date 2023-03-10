<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Journal;
use App\Models\SelectData;

class J_JournalController extends Controller
{
  /*
  /-----------------------------------------------------------------------------
  //--------------------   Guardar Journals   ----------------------------------
  /-----------------------------------------------------------------------------
  */


  // Cunado llamo al metodo de saveVIdeo dentro de la ruta se ejecuta la accion que tenga en ele controlador.
  // Asi recibimos los datos por la request y lo asignamos a la variable $REQUEST
  public function saveJournal($response){
    //-------- ERRASE DATABASE----------------

    // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
    // Estonces lo que hago es borrala y volverla a escribir.
    // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
    Journal::whereNotNull('id')->delete();

      // Esto es todo el objeto JSON
      foreach ($response as $result) {

        // -------- NUEVA CARGA -----------
        // Creo una variable para guarda un objeto nuevo
        $journal = new Journal();
          // Recorro cada ELEMENTO del JSON
          // Dentro de cada elemento voy a tener la info

          // ---------Escojer journals --------------
          if( $result['productClass'] == 'journal'){

              //--- Asigno variables dentro del objeto VIDEO
              // Voy metiendo todo lo que me llega por la request dentro de video
              // Es decir cada uno de estas variables con las que tengo en la base de datos.

              $journal -> shortName = $result['shortName'];
              $journal -> orderNumber = $result['orderNumber'];
              $journal -> vendor = $result['vendor'];

              //------------ VAriables que dan problems ----------------
              // ALgunas variables vienen otras no
              // Para evitar que nos de error utilizamos una condicion de SI EXISTE ENTONCES
              if(isset($result['title'])){
                  $journal -> title = $result['title'];
              }
              if(isset($result['publisher'])){
                  $journal -> publisher = $result['publisher'];
              }

              // Aun tengo problmes retriving teh SSN number
              // NO se si viene con otro nombre pero asi asale en el JSON
              if(isset($result[' issn'])){
                  $journal -> publisher = $result['issn'];
              }
              //$journal -> issn = $result['issn'];
              //$journal -> title = $result['title'];
              //$journal -> publisher = $result['publisher'];
              $journal -> jumpStart = $result['jumpStart'];
              $journal -> productClass = $result['productClass'];
              $journal -> startCoverage = $result['startCoverage'];
              $journal -> endCoverage = $result['endCoverage'];

              // Asi es como se gurada un video en la base de datos
              $journal-> save();

            }
          }
        }

  public function selectJournal1(Request $request){

        //-------- ERRASE DATABASE----------------

        // COmo son base de datos temporales(guardan la informacion de la busqueda actual.) necesitamos sobreescribirla
        // Estonces lo que hago es borrala y volverla a escribir.
        // Como llamo al objeto directamente llamando al MODELO borro lo que tenga adentro
        //SelectData::whereNotNull('id')->delete();


        $arrayAll = $request->all();

        //saco el numero de elementos
        $longitud = count($arrayAll['journal']);

        $group = $request->input('group');
        $order = $request->input('order');

        foreach (range(0, $longitud-1) as $i) {
            // -------- NUEVA CARGA -----------
            // Creo una variable para guarda un objeto nuevo
            $database = new SelectData();

            //--- Asigno variables dentro del objeto
            // Voy metiendo todo lo que me llega por la request dentro de video
            // Es decir cada uno de estas variables con las que tengo en la base de datos.
            $database -> selection_id = $arrayAll['journal'][$i];
            $database -> type = 'journal';

            // Como recibo la request con los parametros del formulario
            // YA puedo llamar los INPUTS del formulario con el NAME y ID desde la request
            $database -> groups = $request->input('group');
            $database ->  orders = $request->input('order1');

            $database-> save();
          }

          // Este es la forma en que envio un a alert al mismo
          // Tambien le paso parametros con WITH y los llamo con SESSION en la vista
          return redirect()->back()->with('message', $longitud.' JOURNAL items have been added to your selection.' )->with('longitudJournal',$longitud);
  }

}
