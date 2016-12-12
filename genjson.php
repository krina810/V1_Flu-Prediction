<?php
if (file_exists("results.json")){
	if (copy("results.json","results_old.json")) {
		unlink("results.json");
		require_once('db.php');
                $result_json = mysqli_query($link,"SELECT user_name, tweet_text, latitude, longitude, tweet_date, aggravation FROM flu_tweets;");

          
		$rows = array();
                $fp = fopen('results.json', 'w');
                fwrite($fp, "[");
		while($r = mysqli_fetch_assoc($result_json)) {
			$rows[] = $r;
                        $data = json_encode($r);
                        //echo "$data";
                        if ($data) {
                           fwrite($fp, $data);
                           fwrite($fp, ",");
                        }  
		}
                fwrite($fp, "{}]");
                echo "Wrote JSON to file";
		fclose($fp);
                echo "Closed file";
		}
	else {
		echo "JSON ERROR: couldnt rename/move";
		}
	}
else {
	echo "JSON ERROR: file not found";
	}
?>
