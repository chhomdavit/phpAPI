<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
    include '../db.php';

    $data = json_decode(file_get_contents("php://input"));

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
      echo json_encode(array("status" => "error"));
      die();
    }

    try {
      $stmt = $dbh->prepare ("INSERT INTO user (firstname, lastname, email, avatar_img) VALUES (?, ?, ?, ?)");
      $stmt->bindParam(1, $data -> firstname);
      $stmt->bindParam(2, $data -> lastname);
      $stmt->bindParam(3, $data -> email);
      $stmt->bindParam(4, $data -> avatar_img);
      
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