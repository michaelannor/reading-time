<?php

/**
 * @author: Michael Annor
 * project: counting sheep (working title)
 * description: action page to return reading time from set text
 */

  $cmd = $_REQUEST['cmd'];
  switch ($cmd) {
    case "1":
      get_reading_time();
      break;

    default:
      # code...
      break;
  }



	function get_reading_time() {

    $default_wpm = 200;
    $wpm;
    $warning;

    if (isset($_REQUEST['text'])){
      $text = $_REQUEST['text'];
      if (isset($_REQUEST['wpm'])){
        if ($_REQUEST['wpm'] > 0){
          $wpm = $_REQUEST['wpm'];
        }
        else {
          $wpm = $default_wpm;
          $warning[0] = "incorrect reading speed set, default used";
        }
      }
      else {
        $wpm = $default_wpm;
        $warning[1] = "no reading set, default used";
      }

			$word_count = word_count_helper($text);
			$reading_time = reading_time_helper($word_count, $wpm);
         //generate the JSON message to echo to the browser
           echo '{"result":1,"text":';	//start of json object
           echo json_encode($text);			//convert the result array to json object
           echo ',"word count":';	//start of json object
           echo json_encode($word_count);			//convert the result array to json object
           echo ',"reading speed (wpm)":';	//start of json object
           echo json_encode($wpm);			//convert the result array to json object
           echo ',"reading time":';	//start of json object
           echo json_encode($reading_time." minute(s)");			//convert the result array to json object
           echo ',"warnings":';	//start of json object
           echo json_encode($warning);			//convert the result array to json object
           echo "}";							//end of json array and object
	  }
    else {
      $error =  "No text was set";
      echo '{"result":1,"text":';	//start of json object
      echo json_encode($error);			//convert the result array to json object
      echo "}";
    }
  }

  function word_count_helper($text)
  {
		 $text_array = explode(" ",$text);
		 $count = count($text_array);
     return $count;
  }

  function reading_time_helper($wordcount, $wpm)
  {
    $reading_time = $wordcount / $wpm;
    return round($reading_time);
  }

?>
