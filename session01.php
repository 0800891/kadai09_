<?php
session_start();

// $name = 'John Doe';
// $age = 25;

// echo $name . $age;

// $_SESSION['name'] = $name;
// $_SESSION['age'] = $age;

$old_session_id = session_id();

//,,,,,,,,,,,,,,,,,,

session_regenerate_id(true);

$new_session_id = session_id();
echo $old_session_id;
echo '<br>';
echo $new_session_id;

?>

