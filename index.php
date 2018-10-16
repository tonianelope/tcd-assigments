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
    $subdomains = Explode(".", $_SERVER["SERVER_NAME"]);
    $username = $subdomains[0];

	  $file = file_get_contents("./dl.json");
	  $data = json_decode($file);
    // set default mode
    $mode = $data->modes->{$username} ?: [];
    //$mode = [];

    // load modes
    if($data->modes){
        echo "<h4>Select a mode</h4>";
        echo "<form id='modes'>";
        foreach($data->modes as $key => $val){
            $vals = implode(' ', $val);
            echo "<input type='checkbox' value='$vals'" .
                (($key == $username) ? " checked='' " : "")
               . ">$key";
        }
        $vals = implode(' ',array_keys((array)$data->modules));
        echo "<input type='checkbox' value='$vals' >all";
        echo "</form>";
    }

    // module options
	  if($data->modules){
        echo "<h4>Select modules</h4>";
		    echo "<form id='options' >";
		    foreach($data->modules as $key => $val){
		        echo "<input type='checkbox' name='$key' " .
               (in_array($key, $mode) ? "checked='checked'" : "")
                . ">$val";
		    }
		    echo "</form>";
	  }

    // render assigments
	  if(count($data->assignments)){
        echo "<h4>Stuff to do</h4>";
		    echo "<table>";
		    usort($data->assignments, function($a, $b){
			      return strcmp($a->due, $b->due);
		    });
		    foreach ($data->assignments as $idx => $todo){
            $due = new DateTime($todo->due);
            $prev = new DateTime('yesterday');
            if($due>=$prev){
			          echo "<tr " .
                     ($todo->module ? "class='$todo->module' " : "") .
                     (in_array($todo->module, $mode) ? "" : "display='none' ")
                   . ">" ;
                $diff = $prev->diff($due);
                echo "<td>" . $due->format("d/m") ."</td>";
			          echo "<td>" . $diff->format("%a") . "</td>";
				        echo "<td>" . ($todo->link ? "<a href=$todo->link>$todo->title</a>" : $todo->title) ."</td>";
                echo "<td>" . ($data->modules->{$todo->module}) . "</td>";
                echo "</tr>";
            }
		    }
		    echo "</ul";
	  }
	  ?>
</body>
</html>
