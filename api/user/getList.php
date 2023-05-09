<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
    include '../db.php';

    try {
        $users = array();
        foreach($dbh->query('SELECT * from  user') as $row) {
            array_push($users, array(
                'id' => $row['id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'email' => $row['email'],
                'avatar_img' => $row['avatar_img'],
            ));
        }
        echo json_encode($users);
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }






?>