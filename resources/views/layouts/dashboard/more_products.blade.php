
            <!-- Le meto una funcion de Java script para que seleccione todo
                Si el parametro se envia se añade sino se hace un GRAY OUT a todo el contenido-->

            <label class="form-check-label" for="more_products">
                <p style="color:red"><input type="checkbox" name ="more_products" id="more_products" value="more_products"/>
                <b>More Products</b></p>
            </label><br>

            <div id="dvMoreProducts" style="display: none; padding-left: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
              <input class="form-check-input" type="checkbox" name = "ciam" value="ciam">
              <label class="form-check-label" for="flexCheckChecked">
                <p>CIAM</p>
              </label><br>

              <input class="form-check-input" type="checkbox" name = "lipincott" value="lipincott">
              <label class="form-check-label" for="flexCheckChecked">
                <p>Lipincott</p>
              </label><br>

              <input class="form-check-input" type="checkbox" name = "biodigital" value="biodigital">
              <label class="form-check-label" for="flexCheckChecked">
                <p>BioDigital</p>
              </label><br>

              <input class="form-check-input" type="checkbox" name = "biocyc" value="biocyc">
              <label class="form-check-label" for="flexCheckChecked">
                <p>BioCyc</p>
              </label><br>
            </div>


            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script type="text/javascript">
            /* ---------------------------------- */
            /*  FUNCION SHOW ADITIONAL DATABASES  */
            /* ---------------------------------- */
            $(function () {
                $("#more_products").click(function () {
                    if ($(this).is(":checked")) {
                        $("#dvMoreProducts").show();
                    } else {
                        $("#dvMoreProducts").hide();
                    }
                });
            });

              </script>
