<!DOCTYPE html>
<html>
<head>
    <title>What you should be doing</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="index.js"></script>
</head>
<body>

    <h1>Stuff you should be doing</h1>

    <?php
	  $file = file_get_contents("./dl.json");
	  $data = json_decode($file);

	  if($data->modules){
		    // print_r($json->modules);
		    echo "<form id='options' action='/'>";
		    foreach($data->modules as $key => $val){
		        echo "<input type='checkbox' name='$key' onclick='runOption($key)'>$val";
		    }
		    echo "</form>";
	  }

	  if(count($data->assignments)){
		    echo "<table>";
		    usort($data->assignments, function($a, $b){
			      return strcmp($a->due, $b->due);
		    });
		    foreach ($data->assignments as $idx => $todo){
			      echo "<tr " . ($todo->module ? "class='$todo->module'" : "") . ">" ;
			      echo "<td>" . date('m/d', strtotime($todo->due)) . "</td>";
				    echo "<td>" . ($todo->link ? "<a href=$todo->link>$todo->title</a>" : $todo->title) ."</td>";
			      echo "</tr>";
		    }
		    echo "</ul";
	  }
	  ?>

</body>
</html>
