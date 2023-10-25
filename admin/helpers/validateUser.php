<?php

function test_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

    
}

function validateLogin($user){
    $errors = array();

    if (empty($user['id_number'])) {
        array_push($errors, 'Matric no. or Staff id. is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password required');
    }
    return $errors;
}





function validateUser($user){

    $errors = array();

    if (empty($user['surname'])) {
        array_push($errors, 'Surname is required');
    }

    if (empty($user['firstname'])) {
        array_push($errors, 'Firstname is required');
    }elseif ($user['firstname'] && !preg_match("/^[a-zA-Z-']*$/", $user['firstname']) || $user['surname'] && !preg_match("/^[a-zA-Z-']*$/", $user['surname']) || $user['denomination'] && !preg_match("/^[a-zA-Z-']*$/", $user['denomination']) || $user['othernames'] && !preg_match("/^[a-zA-Z-']*$/", $user['othernames']) || $user['gender'] && !preg_match("/^[a-zA-Z-']*$/", $user['gender'])) {
        array_push($errors, 'Only letters and whitespaces allowed');
    }

    if (empty($user['denomination'])) {
        array_push($errors, 'Denomination is required');
    }


    

    if(empty($user['gender'])){
        array_push($errors, 'Select Gender');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    } /* elseif ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Check Your Email');
    } */

    if(empty($user['phone_number'])){
        array_push($errors, 'Phone Number is required');
    }/* elseif ($user['phone_number'] && !preg_match("/^[0-9']*$/", $user['phone_number'])) {
        array_push($errors, 'Check Your Phone Number');
    }*/

    

    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }elseif($user['password'] && strlen($user['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }elseif($user['password'] && strlen($user['password']) > 21){
        array_push($errors, 'Password is too long');
    }


    if($user['passwordConf'] !== $user['password']){
        array_push($errors, 'Passwords do not match');
    }


    /*
    $existingUser = selectOne('users', ['email' => $user['email']]);
    $existingUser1 = selectOne('users', ['id_number' => $user['id_number']]);
    


    if($existingUser || $existingUser1){
        array_push($errors, 'User exists');
    }*/

    

    return $errors;
}

function validateUserUpdate($user){

    $errors = array();

    if (empty($user['surname'])) {
        array_push($errors, 'Surname is required');
    }

    if(empty($user['firstname'])){
        array_push($errors, 'Firstname is required');
    }

    if(strlen($user['id_number']) > 10){
        array_push($errors, 'Username must not be more 10 Characters');
    }

    if(empty($user['gender'])){
        array_push($errors, 'Select Gender');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    }

    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }


    if(strlen($user['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }

    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user['email'])){
        array_push($errors, 'Invalid Email');
    }

    if($user['passwordConf'] !== $user['password']){
        array_push($errors, 'Passwords do not match');
    }


    
    $existingUser = selectOne('users', ['email' => $user['email']]);
    $existingUser1 = selectOne('users', ['id_number' => $user['id_number']]);
    


    if($existingUser && $existingUser['id'] != $user['id']){
        array_push($errors, 'User exists');
    }elseif ($existingUser1 && $existingUser1['id'] != $user['id']) {
        array_push($errors, 'User exists');
    }

    

    return $errors;
}





function validateRegister($user){

    $errors = array();

    if (empty($user['surname'])) {
        array_push($errors, 'Surname is required');
    }

    if (empty($user['firstname'])) {
        array_push($errors, 'Firstname is required');
    }
    
    
    if ($user['firstname'] && !preg_match("/^[a-zA-Z-']*$/", $user['firstname']) || $user['surname'] && !preg_match("/^[a-zA-Z-']*$/", $user['surname']) || $user['denomination'] && !preg_match("/^[a-zA-Z-']*$/", $user['denomination']) || $user['othernames'] && !preg_match("/^[a-zA-Z-']*$/", $user['othernames']) || $user['gender'] && !preg_match("/^[a-zA-Z-']*$/", $user['gender'])) {
        array_push($errors, 'Only letters and whitespaces allowed');
    }

    if (empty($user['denomination'])) {
        array_push($errors, 'Denomination is required');
    }


    

    if(empty($user['gender'])){
        array_push($errors, 'Select Gender');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    }elseif ($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Check Your Email');
    }

    if(empty($user['phone_number'])){
        array_push($errors, 'Phone Number is required');
    }elseif ($user['phone_number'] && !preg_match("/^[0-9]+$/", $user['phone_number'])) {
        array_push($errors, 'Check Your Phone Number');
    }

    

    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }elseif($user['password'] && strlen($user['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }elseif($user['password'] && strlen($user['password']) > 21){
        array_push($errors, 'Password is too long');
    }


    if($user['passwordConf'] !== $user['password']){
        array_push($errors, 'Passwords do not match');
    }


    
    $existingUser = selectOne('users', ['email' => $user['email']]);
   
    


    if($existingUser){
        array_push($errors, 'User exists');
    }

    

    return $errors;
}






function validateFile($file, $formIndex, $filetype, $filesize){
    $errors = array();

    $thumbnail = $file[$formIndex];
    
    $time = time(); //to make each image name unique
    $thumbnail_name = $time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];
    
    

    $allowed_files = $filetype;
    $extension = explode('.', $thumbnail_name);
    
    $extension = end($extension);

    if(!in_array($extension, $allowed_files)) {
        array_push($errors, 'Only jpg, jpeg, webp, png files allowed');
    }

    if ($thumbnail['size'] > $filesize) {
        array_push($errors, 'file is too large');
    }

    return $errors;
}