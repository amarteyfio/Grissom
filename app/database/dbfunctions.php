<?php

require 'connection.php';

function dd($value) // to be deleted
{
    echo "<pre>",print_r($value,true), "</pre>";
    die();
}

//Function to select all from table
function selectAll($table){
    global $db;
    $sql = "SELECT * FROM $table";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


//Execute Query function
function executeQuery($sql, $data){
    global $db;
    $stmt = $db->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s',count($values));
    $stmt->bind_param($types,...$values);
    $stmt->execute();
    return $stmt; 
    
}



//select with condition
function selectALLif($table, $conditions = []){
    global $db;
    $sql = "SELECT * FROM $table";
    if(empty($conditions)){
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
     }
     else{
        //return records that match conditions
        $i = 0;
        foreach ($conditions as $key => $value){
            if ($i === 0){
            $sql = $sql . " WHERE $key=?";
        } 
        else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $stmt = $db->prepare($sql);
    $values = array_values($conditions);
    $types = str_repeat('s',count($values));
    $stmt->bind_param($types,...$values);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
 }

}



//select one record
function selectOne($table, $conditions){
    global $db;
    $sql = "SELECT * FROM $table";
    $i = 0;
        foreach ($conditions as $key => $value){
            if ($i === 0){
            $sql = $sql . " WHERE $key=?";
        } 
        else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $stmt = $db->prepare($sql);
    $values = array_values($conditions);
    $types = str_repeat('s',count($values));
    $stmt->bind_param($types,...$values);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}






function create($table,$data){
    global $db;
    //$sql = INSERT INTO post SET username = ?,admin = ?, email = ?, password = ?"
    $sql = "INSERT INTO $table SET";

    $i = 0;
    foreach ($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } 
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }  
    
    $stmt = executeQuery($sql,$data);
    $id = $stmt->insert_id;
    return $id;
}



//update function
function update($table,$id,$data){
    global $db;
    //$sql = UPDATE post SET username = ?,admin = ?, email = ?, password = ?", WHERE id=?"
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value){
        if ($i === 0){
            $sql = $sql . " $key=?";
        } 
        else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    } 
    $sql = $sql . " WHERE id= ?"; 
    $data['id'] = $id; 
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}
//Update Function


//Delete function
function delete($table,$id){
    global $db;
    //$sql = DELETE FROM post WHERE id=?"
    $sql = "DELETE FROM $table WHERE id=? ";
    
    $stmt = executeQuery($sql,['id' => $id]);
    return $stmt->affected_rows;

}    

//get article id
$table= 'students';
$id = "";
$title = "";
$body = "";

if (isset($_GET['id'])) {
    $student = selectOne($table, ['id' => $_GET['id']]);

    $id = $student['id'];
    $name = $student[''];
    $age = $student['age'];
    
}



















?>

