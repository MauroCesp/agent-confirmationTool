
@if(count($databases)>=1)

  <!------------------------------------->
  <div class="form-check">

    <!-- Le meto una funcion de Java script para que seleccione todo
        Si el parametro se envia se añade sino se hace un GRAY OUT a todo el contenido-->

    <label class="form-check-label" for="open">
        <input type="checkbox" name ="database" id="open" value="database" checked/>
        Data Bases
    </label>


    <!-- Comparo la lista de los formatShortName que saco de la base de datos
        Lo compro con la array que creo en el controlador con los nombres completo s-->
    <div id="dvOpen" style="padding-left: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
      <div class="wk-row">
        <div class="wk-col-8">
        </div>
        <div class="wk-col-4">
          <!-- Le meto una funcion de Java script para que seleccione todo -->
          <input class="form-check-input" type="checkbox"  onclick= 'checkUncheck(this)' name = "check" value="check"checked>
          <label class="form-check-label" for="flexCheckChecked">
              <p>Select All</p>
            </label><br>
        </div>
      </div>

      <!-- COmparo lo que vienen de la base de datos con el array que tengo de valores validos -->
      <!-- Asi filtro los valores que no deseo exportar -->
      @foreach ($unique_db as $value)
    		        @foreach ($list_dbs as $key=>$i)
    			         @if($key == $value)

              <!-- Le meto el value para que pueda enviar el formatShortName de cada uno
                  Le pongo clase TAKE para notener que usar el NAME ya que lo necesito para regresar el valor-->
              <input class="take" type="checkbox" name = {{$value}} value={{$value}} checked>
        	             <label class="form-check-label" for="flexCheckChecked">
                  <p>{{$list_dbs[$value]}}</p>
                </label><br>

            @endif
    		       @endforeach
    		     @endforeach
    </div>
  </div>
@else
  <div class="wk-notification wk-is-open wk-notification-error" role="alert">
    <span class="wk-icon-filled-stop-sign"style="font-size: 1.25rem;" aria-hidden="true"></span>
    <p class="wk-notification-title" style="font-size: 1.25rem;">This customer doesn't have databases</p>
  </div>

@endif

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
/* ---------------------------------- */
/*  FUNCION SHOW ADITIONAL DATABASES  */
/* ---------------------------------- */
$(function () {
    $("#open").click(function () {
        if ($(this).is(":checked")) {
            $("#dvOpen").show();
        } else {
            $("#dvOpen").hide();
        }
    });
});
    /* ---------------------------------- */
    /*    FUNCION UNCHECK / CHECK         */
    /* ---------------------------------- */
    function checkUncheck(checkBox) {

    // Le puse este nombre al loop que escupe los elementos de la base de datos
    get = document.getElementsByClassName('take');
    for(var i=0; i<get.length; i++) {
    get[i].checked = checkBox.checked;}
    }



  </script>
