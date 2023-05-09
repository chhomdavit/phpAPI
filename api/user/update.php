<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
    include '../db.php';

    $data = json_decode(file_get_contents("php://input"));

    if($_SERVER['REQUEST_METHOD'] !== 'PUT'){
      echo json_encode(array("status" => "error"));
      die();
    }

    try {
      $stmt = $dbh->prepare ("UPDATE `user` SET firstname=?, lastname=?, email=?, avatar_img=? WHERE id=?");
      $stmt->bindParam(1, $data -> firstname);
      $stmt->bindParam(2, $data -> lastname);
      $stmt->bindParam(3, $data -> email);
      $stmt->bindParam(4, $data -> avatar_img);
      $stmt->bindParam(5, $data -> id);
      
      if($stmt->execute()){
        echo json_encode(array("status" => "ok"));
      }else{
        echo json_encode(array("status" => "error"));
      }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }






?>