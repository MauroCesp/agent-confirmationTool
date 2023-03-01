<!-- Le meto una funcion de Java script para que seleccione todo
    Si el parametro se envia se añade sino se hace un GRAY OUT a todo el contenido-->

<label class="form-check-label" for="silver_chair">
    <input type="checkbox" name ="silver_chair" id="silver_chair" value="silver_chair"/>
    Silver Chair:
</label><br>

<div id="dvSilverChair" style="display: none; padding-left: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
  <input class="form-check-input" type="checkbox" name = "health_library" value="health_library">
  <label class="form-check-label" for="flexCheckChecked">
    <p>Health Library</p>
  </label><br>

  <input class="form-check-input" type="checkbox" name = "bates" value="bates">
  <label class="form-check-label" for="flexCheckChecked">
    <p>Bates</p>
  </label><br>

  <input class="form-check-input" type="checkbox" name = "aclands" value="aclands">
  <label class="form-check-label" for="flexCheckChecked">
    <p>Aclands</p>
  </label><br>

  <input class="form-check-input" type="checkbox" name = "fiveMinute" value="fiveMinute">
  <label class="form-check-label" for="flexCheckChecked">
    <p>5Minutes</p>
  </label><br>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
/* ---------------------------------- */
/*  FUNCION SHOW ADITIONAL DATABASES  */
/* ---------------------------------- */
$(function () {
    $("#silver_chair").click(function () {
        if ($(this).is(":checked")) {
            $("#dvSilverChair").show();
        } else {
            $("#dvSilverChair").hide();
        }
    });
});

  </script>
