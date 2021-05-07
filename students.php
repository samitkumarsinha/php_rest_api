<?php
    include('dbcon.php'); //connection file included
    $method = $_SERVER['REQUEST_METHOD']; //post, get, delete, put
    $input = json_decode(file_get_contents('php://input')); //json payload
    switch($method){
        case "GET":
            $id = $_GET['id'];
            if(empty($id)){ //if user send id
                $sql = "SELECT id, name, email FROM students";
                $result = $conn->query($sql);
                $studs = array();
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    array_push($studs,array("id" => $row["id"], "Name" => $row["name"], "Email" => $row["email"]));
                  }
                } else {
                  echo "0 results";
                }
                print_r(json_encode($studs));
                $conn->close();
            }else{ // return all records if user dont send id
                $sql = "SELECT id, name, email FROM students where id = '$id'";
                $result = $conn->query($sql);
                $studs = array();
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    array_push($studs,array("id" => $row["id"], "Name" => $row["name"], "Email" => $row["email"]));
                  }
                } else {
                  echo "0 results";
                }
                print_r(json_encode($studs));
                $conn->close();
            }
        break;
        case "POST":
            $name = $input->name;
            $email = $input->email;
            $password = $input->password;
            $sql = "INSERT into students(name, email, password) values ('$name','$email','$password')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                print_r('Created');
            } else {
              echo 'failed';
            }
            $conn->close();
        break;
        case "DELETE":
            $id = $_GET['id'];
            $sql = "DELETE FROM students WHERE id = '$id'";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                print_r('Deleted');
            } else {
              echo 'failed';
            }
            $conn->close();
        break;
        case "PUT":
            $id = $input->id;
            $name = $input->name;
            $email = $input->email;
            $password = $input->password;
            $sql = "UPDATE students SET name = '$name' , email = '$email', password = '$password' WHERE id = '$id'";
            print_r($sql);
            $result = $conn->query($sql);
            if ($result === TRUE) {
                print_r('Updated');
            } else {
              echo 'failed';
            }
            $conn->close();
        break;
    }
?>				