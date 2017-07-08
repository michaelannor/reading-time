<?php

/**
 * @author: Michael Annor
 * date: 15th November, 2015
 * description: ajax-action page, interfaces with javascript to process commands from the frontend
 */
  $wpm = 200;
  $cmd = $_REQUEST['cmd'];
  switch ($cmd) {
    case "wordcount":
      get_word_count();
      break;

    case "2":
      get_reading_time();
      break;

    default:
      # code...
      break;
  }



	function get_reading_time() {
    $text = $_REQUEST['text'];
    $wpm = $_REQUEST['wpm'];
				 $word_count = get_word_count($text);
// at 200 wpm
				 $reading_time = $word_count / $wpm;
         //generate the JSON message to echo to the browser
           echo '{"result":1,"text":';	//start of json object
           echo json_encode($text);			//convert the result array to json object
           echo ',"word count":';	//start of json object
           echo json_encode($word_count);			//convert the result array to json object
           echo ',"reading speed (wpm)":';	//start of json object
           echo json_encode($wpm);			//convert the result array to json object
           echo ',"reading time":';	//start of json object
           echo json_encode($reading_time);			//convert the result array to json object
           echo "}";							//end of json array and object
	}

	function get_word_count() {
    $text = $_REQUEST['text'];
		 $count = word_count_helper($text);
		 return $count;
	}

  function word_count_helper($text) {
		 $text_array = explode(" ",$text);
		 $count = count($text_array);
     return $count;
  }

?>
