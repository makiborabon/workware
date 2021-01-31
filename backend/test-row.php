<HTML>
<HEAD>
    <TITLE> Inventory / add product</TITLE>
    <SCRIPT language="javascript">
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;

                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
 
    </SCRIPT>
<?php
include('mysqli_connect.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){


				$size 	  = $_POST['size'];
				$quantity 	  = $_POST['quantity'];
				$style	  = $_POST['style'];
				
				
				$size2 = implode(',',$size);
				$quantity2 = implode(',',$quantity);
				$style2 = implode(',',$style);

				
				
				$sql="INSERT INTO test_row (size, quantity, style)
				VALUE
				('$size2', '$quantity2', '$style2')";
				$query = mysqli_query($con, $sql);
				
				mysqli_close($con);
}

?>		
<style>input[value]{color:#666}</style>	
</HEAD>
<BODY>
	<form method="POST" action="" >

	
    <TABLE id="dataTable" width="350px" >
        <button type="button" onclick="addRow('dataTable')" />Add Row</button>
		<button type="button" onclick="deleteRow('dataTable')" />Delete Row</button>
		<TR>
			<TD><INPUT type="checkbox" name="chk"/></TD>
			<TD><input type="text" name="size[]"  pattern="[0-9.]+" placeholder="Size"><TD>
			<TD><INPUT type="text" name="quantity[]" placeholder="Quantity"/> </TD>
			<TD><INPUT type="text" name="style[]" placeholder="Style"/> </TD>
			
			
        </TR>
	 
	 
	
    </TABLE>
	
	<input type="submit">
	<form>
</BODY>
</HTML>