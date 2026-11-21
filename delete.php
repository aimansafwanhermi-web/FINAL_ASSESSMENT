<?php
include 'db.php';


if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = $conn->prepare("DELETE FROM result WHERE id = $id");
    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Delete failed: " . $sql->error;
    }
}
?>