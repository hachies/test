<?php
if (isset($_GET['process'])) {
    echo "<h1>Successfully</h1>";
}
session_start();
if (!$_SESSION['is_ingelogd']) {
    header("Location:roostermaker-login.php");
}
include 'header.php';
include 'gebruiker.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inloggen</title>
</head>
<body>
    <h3><?php echo "Welkom ". $_SESSION['username']; ?></h3>
    <a href="logout.php"><h2>Uitloggen</h2></a><br>

    <a href="user-insert.php"><h2>Insert User</h2></a><br>
    <a href="../product/product-insert.php"><h2>Insert Product</h2></a><br>



    <table class="table table-dark">
        <tr>
            <th>id</th>
            <th>email</th>
            <th>wachtwoord</th>
            <th colspan="2">action</th>
        </tr>

        <tr>
        <?php 
            $users = new Gebruiker ($myDb);
            try {
                $result = $users->getAllGebruikers();
                if ($result) {
                    foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><a href="user-edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                            <td><a href="user-delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                        </tr>
                    <?php }
                }
            } catch (Exception $e) {

                echo 'Error: ' . $e->getMessage();
            }
    ?>
</table>


</body>
</html>
