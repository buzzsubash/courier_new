<?php

function is_development(){
	if(ENVIRONMENT=='development'){
		return true;
	}else{
		return false;
	}
}

function debug($var,$name=null,$file=null,$line=null){
	if(is_development()){
		$enable = 1;
	}else{
		$enable = 0;
	}
	
	if($enable){
		echo "<div  style='margin: 10px; background: #FCFCFC; padding: 10px; z-index:999999999999999; position: relative'>";
		if(isset($name)){echo "<div style='padding-bottom: 10px; font-weight: bold; border-bottom: 1px solid #DDD'>".$name."</div>"; }
		if(isset($var)){
			echo "<pre>"; 
			print_r($var);
			echo '</pre>';
		}else{
			echo 'Not Set';
		}
		
		if($file)
		echo "<br>Filename: ". $file."";
		if($line)
		echo "<br>Line: ". $line;
		echo '</div>';
	}
}

function d($var,$name=null,$file=null,$line=null){
	if(is_development()){
		$enable = 1;
	}else{
		$enable = 0;
	}
	
	if($enable){
		echo "<div  style='margin: 10px; background: #FCFCFC; padding: 10px; border: 1px solid #DDD;font-family: arial'>";
		if(isset($name)){echo "<div style='padding-bottom: 10px; font-weight: bold; border-bottom: 1px solid #DDD'>".$name."</div>"; }
		if(isset($var)){
			echo "<pre>"; 
			print_r($var); 
			echo '</pre>';
		}else{
			echo 'Not Set';
		}
		
		if($file)
		echo "<br>Filename: ". $file."";
		if($line)
		echo "<br>Line: ". $line;
		echo '</div>';
	}
}