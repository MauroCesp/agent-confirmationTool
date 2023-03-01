<div class="wk-notification wk-is-open wk-notification-success" role="alert">
  <span class="wk-icon-filled-alert" aria-hidden="true" style="font-size: 1.75rem; top: 1.5rem;"></span>
  <p class="wk-notification-content" style="font-size: 1.75rem;">
    <b>Access type</b>
  </p>
</div>

<div class="form-check">


  <label class="form-check-label" for="chkPassport">
    <input type="checkbox" name = "openAthens" value = "openAthens" id="chkPassport" />
        OpenAthens
  </label>

  <div id="dvPassport" style="display: none; padding-left: 40px;background-color: #ffffff; border: 1px solid #DCDCDC; padding: 30px">
      Entity ID:
      <input class="form-check-input" type="text" name = "entityID" placeholder="Entity Id">
  </div>

</div>




<div class="form-check">
  <input class="form-check-input" type="checkbox" name = "shibboleth" value="shibboleth">
  <label class="form-check-label" for="flexCheckChecked">
    <p>Shibboleth</p>
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name = "ip_access" value="ip_access">
  <label class="form-check-label" for="flexCheckChecked">
    <p>IP</p>
  </label>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script>
