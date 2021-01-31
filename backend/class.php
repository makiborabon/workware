<?php
class SimpleClass{
    // property declaration
    public $var = 'Go Object Oriented Programming';
	public $plus = 20;
	public $tensi = 20;
	


	
    // method declaration
    public function displayVar() {
        echo $this->var;
    }
	
	
	public function compute() {
       
		echo '<center><br><br><br><br><br><br>';
		echo '<label>Calculator</label>';
		echo '<form method="POST" action="">';
		echo '<input type="text" name="entry-1"><br>';
		echo '<select name="math">
			  <option value="+">+</option>
			  <option value="-">-</option>
			  <option value="*">*</option>
			  <option value="/">/</option>
			</select><br>';
		echo '<input type="text" name="entry-2"><br>';
		
		echo '<input type="submit" name="submit" value="Compute">';
		echo '</center>';
			
	if(isset($_POST['submit'])){
				$num1 = $_POST['entry-1'];
				$num2 = $_POST['entry-2'];
				$operand = $_POST['math'];
			
			
			if($operand == "+"){
				
				$plus = $num1 + $num2;
				echo '<center>'.$plus.'</center>';
			}
			if($operand == "-"){
			
				$minus = $num1 - $num2;
				echo '<center>'.$minus.'</center>';
			}
			if($operand == "*"){
			
				$multiply = $num1 * $num2;
				echo '<center>'.$multiply.'</center>';
			}
			if($operand == "/"){
			
				$divide = $num1 / $num2;
				echo '<center>'.$divide.'</center>';
			}
			
			
		}

		
		
		
		
    }
}



$display = new SimpleClass();
$display->compute();

?>