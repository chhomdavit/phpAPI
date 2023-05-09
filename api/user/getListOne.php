<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
    include '../db.php';

    try {
        $stmt = $dbh->prepare("SELECT * FROM user where id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row) {
          $user = array(
            'id' => $row['id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'avatar_img' => $row['avatar_img'],
          );
          echo json_encode($user);
        break;
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }






?>