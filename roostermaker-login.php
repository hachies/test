<?php
include 'header.php';
include 'gebruiker.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new Gebruiker($myDb);
    try {
        $email = htmlspecialchars($_POST['email']);
        $wachtwoord = htmlspecialchars($_POST['wachtwoord']);
        $userExist = $user->login($email, 'roostermaker');

        if ($userExist) {
            echo '<pre>';
            print_r($userExist);
            echo '</pre>';

            $passVerify = password_verify($wachtwoord, $userExist['wachtwoord']);
            if ($passVerify) {
                session_start();
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_id'] = $userExist['id'];
                $_SESSION['email'] = $userExist['email'];
                header("Location: roostermaker-view.php?logged_in");
                exit();
            } else {
                $error_message = "Verkeerde email of wachtwoord.";
            }
        } else {
            $error_message = "Incorrect username or password or you don't have permission to log in as a roostermaker.";
        }
    } catch (\Exception $e) {
        $error_message = 'Error: ' . $e->getMessage();
    }
}

if (isset($error_message)) {
    echo $error_message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="wachtwoord" placeholder="wachtwoord" required>
        <input type="submit">
    </form>
</body>
</html>
