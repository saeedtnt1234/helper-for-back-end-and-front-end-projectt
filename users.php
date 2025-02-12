<?php

require_once "DB.php";
require_once "helpers.php";

function createUser($name,$email,$password,$image)
{
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO users SET name=?, email=?, password=?,image=?, created_at=now()";
     global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name,$email,$hashed_password,$image]);
}

function checkUser($email){
    $sql = "SELECT * FROM users WHERE email=?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    return  $stmt->fetch();
}

function getUserById($id){
    $sql = "SELECT * FROM users WHERE id=?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return  $stmt->fetch();
}

function checkPassword($password){
    if(strlen($password) < 6){
        return false;
    }
    return true;
}

function getAllUsers(){
    $sql = "SELECT * FROM users";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return  $stmt->fetchAll();
}

function updateUser($id,$name,$password,$image){
    $user = getUserById($id);
    if(!empty($password)){
        $password = password_hash($password,PASSWORD_DEFAULT);
    }else{
        $password = $user->password;
    }
    if(isset($image) && !empty($image['name'])){
        $image= uploadImage($image,'users');
    }else{
        $image= $user->image;
    }

    $sql = "UPDATE users SET name=?,password=?,image=?, updated_at=now() WHERE id=?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name,$password,$image,$id]);
}


function deleteUserById($id){
    $sql = "DELETE FROM  users WHERE id=?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}





