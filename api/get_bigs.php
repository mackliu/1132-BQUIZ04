<?php include_once "db.php";

$bigs=$Type->all(['big_id'=>0]);
foreach($bigs as $big){
    echo "<option value='{$big['id']}'>{$big['name']}</option>";
}