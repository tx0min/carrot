<?php
function dump($msg){
    echo "<pre>";
    var_dump($msg);
    echo "</pre>";
}

    $servername = "localhost";
    $username = "ultminct_wp675";
    $password = "Sv681][P3P";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    dump("Connected successfully");

    $project_ids=[];

    $sql = "SELECT ID FROM wpandu_posts where post_type='projects' and post_status='publish'";
    dump($sql);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $project_ids[]=$row["ID"];
        }
    } else {
        echo "0 results";
    }

    dump($project_ids);


