<div>Product ID: <input type="text" maxlength="10" name="prod_id" id="prod_id" /><span id="status"></span></div>
<script type="text/javascript">
document.getElementById("prod_id").onblur = function() {
var xmlhttp;
var prod_id=document.getElementById("prod_id");
if (prod_id.value != "")
{
if (window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("status").innerHTML=xmlhttp.responseText;
}
};
xmlhttp.open("GET","ifexistname.php?prod_id="+encodeURIComponent(prod_id.value),true);
xmlhttp.send();
}
};
</script>
