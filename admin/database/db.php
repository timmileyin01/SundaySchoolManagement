<?php

session_start();
require('connect.php');


function dd($value){
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


function executeQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}


function selectAll($table, $conditions = []){
    global $conn;
    $sql = "SELECT * FROM $table ";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }else{
        //return only records that match conditions
        // $sql = "SELECT * FROM $table WHERE id_number=? OR email=? AND admin=1";
        
        $i = 0;

        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            }else{
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
   
}



function selectOne($table, $conditions){
    global $conn;
    $sql = "SELECT * FROM $table ";
   
        
    $i = 0;

    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        }else{
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";
    
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;   
}



function create($table, $data){
    global $conn;
    
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}


function prepare_sql($sql)
                        {
                            global $conn;
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $records = $stmt->get_result();
                            return $records;
                        }




function update($table, $id, $data){
    global $conn;
    
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}



function delete($table, $id){
    global $conn;
    
    $sql = "DELETE FROM $table WHERE id=? ";
   
    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}





function createToken() {
    $seed = random_bytes(8);
    $t = time();
    //session_id();

    $hash = hash_hmac('sha256', session_id() . $seed . $t, CSRF_TOKEN_SECRET, true);
    return urlSaveEncode($hash . '|' . $seed . '|' . $t);
    
}

function validateToken($token) {

    $parts = explode('|', urlSaveDecode($token));

    if (count($parts) === 3) {
        $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], CSRF_TOKEN_SECRET, true);

        if (hash_equals($hash, $parts[0])) {
            return true;
        }
    }

    return false;
}


function urlSaveEncode($m){
    return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
}

function urlSaveDecode($m){
    return base64_decode(strtr($m, '-_', '+/' ));
}


