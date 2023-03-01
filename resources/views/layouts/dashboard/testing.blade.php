<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
  <td style="width: 49.9203%;">
    <label class="form-check-label" for="CAB">
      <input type="checkbox" name ="CAB" id="CAB" value="CAB"/>
    </label><br>
  </td>
  <td style="width: 49.9203%;">
    <img src="../../../ui/shared/public/upload/mceu_98795834611676998372713.jpg-638125951730863856.jpg" width="273" height="91" />
  </td>
</tr>

<tr>
  <td style="width: 49.9203%;">
    <label class="form-check-label" for="ZOO">
        <input type="checkbox" name ="ZOO" id="ZOO" value="ZOO"/>
    </label><br>
  </td>
  <td>
    <p><img src="../../../ui/shared/public/upload/mceu_36353223721676998400225.webp-638125952005373362.webp" width="276" height="85" /></p>
  </td>
</tr>
</tbody>
</table>

<div id="dvCAB" style="display: none">
  <h3 style="padding-left: 40px;"><span style="text-decoration: underline;">
    <a href="https://ovidsp.ovid.com/ovidweb.cgi?T=JS&amp;NEWS=n&amp;CSC=Y&amp;PAGE=main&amp;D=b23zz" title="Biological Abstracts &lt;1969 to February 2023&gt;" target="_blank" rel="noopener">Biological Abstracts &lt;1969 to February 2023&gt;</a></span></h3>


  <h3 style="padding-left: 40px;"><span style="text-decoration: underline;">
    <a href="https://ovidsp.ovid.com/ovidweb.cgi?T=JS&amp;NEWS=n&amp;CSC=Y&amp;PAGE=main&amp;D=biobarc" title="Biological Abstracts Archive &lt;1926 to 1968&gt;" target="_blank" rel="noopener">Biological Abstracts Archive &lt;1926 to 1968&gt;</a></span></h3>


  <h3 style="padding-left: 40px;"><span style="text-decoration: underline;">
    <a href="https://ovidsp.ovid.com/ovidweb.cgi?T=JS&amp;NEWS=n&amp;CSC=Y&amp;PAGE=main&amp;D=cabn" title="CAB Abstracts &lt;1990 to 2023 Week 07&gt;">CAB Abstracts &lt;1990 to 2023 Week 07&gt;</a></span></h3>
</div>

<div id="dvZOO" style="display: none">
  <h3 style="padding-left: 40px;"><span style="text-decoration: underline;">
    <a href="https://ovidsp.ovid.com/ovidweb.cgi?T=JS&amp;NEWS=n&amp;CSC=Y&amp;PAGE=main&amp;D=z23rf" title="Zoological Record &lt;1978 to January 2023&gt;">Zoological Record &lt;1978 to January 2023&gt;</a></span></h3>
  <h3 style="padding-left: 40px;"><span style="text-decoration: underline;">
    <a href="https://ovidsp.ovid.com/ovidweb.cgi?T=JS&amp;NEWS=n&amp;CSC=Y&amp;PAGE=main&amp;D=zoorrc" title="Zoological Record Archive &lt;1864 to 1977&gt;" target="_blank" rel="noopener">Zoological Record Archive &lt;1864 to 1977&gt;</a></span></h3>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
/* ---------------------------------- */
/*  FUNCION SHOW ADITIONAL DATABASES  */
/* ---------------------------------- */
$(function () {
    $("#CAB").click(function () {
        if ($(this).is(":checked")) {
            $("#dvCAB").show();
        } else {
            $("#dvCAB").hide();
        }
    });
});

</script>
