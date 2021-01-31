<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sample</title>

</head>
<body>
<script type="text/javascript">

function aff_div(ladiv){
    document.getElementById(ladiv).style.display="inline";
}

function cach_div(ladiv){
    document.getElementById(ladiv).style.display="none";
}

function affich_conj(){
    if(document.forms.devis.votconj[0].checked==true){
        aff_div("ssconj");
    }

    if(document.forms.devis.votconj[1].checked==true){
        document.getElementById("jj").value=0;
        document.getElementById("mm").value=0;
        document.getElementById("aaaa").value=0;
        cach_div("ssconj");
    }

}
</script>

<form  id="devis" name="devis" action="Validation-du-formulaire.php" method="post" >

                        <label>Do you have a wife/husband ?</label>
                        <input type="radio" name="votconj" value="yes" onclick="affich_conj();">yes
                        <input type="radio" name="votconj" value="no" checked="checked" onclick="affich_conj();">no
                        </p>


                        <div id="ssconj">
                        <p>
                        <label>Her/his birthdate :</label>      
                        <select name="jj" id="jj">
                        <option value="0" selected="selected">--</option>
                        <option value="01" >01</option>
                        <option value="02" >02</option>
                        </select>
                        <select name="mm" id="mm">
                        <option value="0" selected="selected">--</option>
                        <option value="01" >01</option>
                        <option value="02" >02</option>
                        </select>
                        <select name="aaaa" id="aaaa">
                        <option value="0" selected="selected">--</option>
                        <option value="1993" >1970</option>
                        <option value="1992" >1969</option>
                        </select>
                        </p>
                        </div>




</form>
<script type="text/javascript">
cach_div("ssconj");
</script>