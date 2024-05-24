<?php
session_start();

$errors = [];

if(isset($_POST['signup'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password !== $confirmPassword) {
        $errors[] = "Mật khẩu xác nhận không khớp";
    }

    if(file_exists('AccountInfo.json')) {
        $accounts = json_decode(file_get_contents('AccountInfo.json'), true);
        foreach($accounts as $account) {
            if($account['email'] === $email) {
                $errors[] = "Email đã tồn tại";
                break;
            }
        }
    }

    if(empty($errors)) {
        $newAccount = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $accounts[] = $newAccount;
        file_put_contents('AccountInfo.json', json_encode($accounts));

        header("Location: login.php");
        exit();
    }
}

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(file_exists('AccountInfo.json')) {
        $accounts = json_decode(file_get_contents('AccountInfo.json'), true);
        foreach($accounts as $account) {
            if($account['email'] === $email && password_verify($password, $account['password'])) {
                $_SESSION['email'] = $email;
                header("Location: survey.php");
                exit();
            }
        }
    }

    $errors[] = "Email hoặc mật khẩu không đúng";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container-1" >
    <form class="login-form" action="" method="post">
        <label>
            <input type="email" name="email" placeholder="Email" required>
        </label><br>
        <label>
            <input type="password" name="password" placeholder="Password" required>
        </label><br>
        <button type="submit" name="login">Login</button>
    </form>
</div>
<div class="container-2">
    <form class="signup-form" action="" method="post">
        <div class="line-1">
            <label>
                <input type="text" name="firstName" placeholder="First Name" required>
            </label><br>
            <label>
                <input type="text" name="lastName" placeholder="Last Name" required>
            </label><br>
        </div>
        <label>
            <input type="email" name="email" placeholder="Email" required>
        </label><br>
        <label>
            <input type="password" name="password" placeholder="Password" required>
        </label><br>
        <label>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
        </label><br>
        <button type="submit" name="signup">Signup</button>
    </form>

</div>


<?php if(!empty($errors)): ?>
    <h3>Error:</h3>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</body>
</html>
