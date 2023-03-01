

<label class="form-check-label" for="atypon">
  <input type="checkbox" name ="atypon" id="atypon" value="atypon" />
      Atypon
</label>

<div id="dvAtypon" style="display: none; padding-left: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name = "aha" value="aha" >
  <label class="form-check-label" for="flexCheckChecked">
    <p>AHA</p>
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name = "asco" value="asco">
  <label class="form-check-label" for="flexCheckChecked">
    <p>ASCO</p>
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name = "aua" value="aua">
  <label class="form-check-label" for="flexCheckChecked">
    <p>AUA</p>
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="checkbox" name = "asa" value="asa">
  <label class="form-check-label" for="flexCheckChecked">
    <p>ASA</p>
  </label>
  </div>
</div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#atypon").click(function () {
            if ($(this).is(":checked")) {
                $("#dvAtypon").show();
            } else {
                $("#dvAtypon").hide();
            }
        });
    });
</script>
