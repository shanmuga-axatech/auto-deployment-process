<?php
$data = file_get_contents ("config.json"); // Configaration file for input 
$json = json_decode($data, true);
if(isset($json) && is_array($json) && count($json)):
foreach ($json as $key => $main_result) {
	echo "<h1>".$key."</h1>";
	$total_count = isset($main_result[0]['source'])?count($main_result[0]['source']):0;
	$source = isset($main_result[0]['source'])?$main_result[0]['source']:"";
	$target = isset($main_result[0]['target'])?$main_result[0]['target']:"";
	$source_list = $target_list = array();
	if(isset($source) && is_array($source) && count($source)):
		foreach ($source as $source_key => $source_value) {
			$source_list[] = $source_value;
		}
	endif;
	if(isset($target) && is_array($target) && count($target)):
		foreach ($target as $target_key => $target_value) {
			$target_list[] = $target_value;
		}
	endif;
	//------------- Main Loop Section starts from here ---------------------------
	if($total_count!=0):
		for ($i=0; $i < $total_count; $i++) { 
			$source_path = $source_list[$i];
			$target_path = $target_list[$i];
			$command = 'cp -R ' . $source_path . ' ' .$target_path; 
			exec($command);
			echo "Successfully copied. You can commit your file now in git";
		}
	else:
		echo "we couldnot find source and destination in ".$key;
	endif;
}
endif;
//--------------------------- Notes or the above script ---------------------------------
// cp -R Dir1 Dir2 => Here the content from Dir1 will be copied to Dir2 if Dir2 doesnot exists means it will create and copy the content
// mv Dir1 Dir2 => This will move the content from one folder to another  ie the folder in Dir1 will be moved to Dir2

?>