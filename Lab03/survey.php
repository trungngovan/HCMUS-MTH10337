<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$errors = [];

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_SESSION['email'];
    $occupation = $_POST['occupation'];

    // Validate dữ liệu (đây là một ví dụ, bạn có thể thêm các quy tắc kiểm tra khác)
    if(empty($name) || empty($age) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($occupation)) {
        $errors[] = "Please complete all information";
    }

    if(empty($errors)) {
        $surveyData = [
            'name' => $name,
            'age' => $age,
            'email' => $email,
            'occupation' => $occupation
        ];

        // Lưu thông tin khảo sát vào tệp JSON
        file_put_contents('Survey.json', json_encode($surveyData));

        echo "Done";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link rel="stylesheet" href="survey.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Survey Form</h1>
    </div>
    <div class="main">
        <p>Let us know how we can improve our website</p>
        <form class="survey-form" action="" method="post">
            <div class="info-field">
                <label class="label">
                    * Name:
                </label>
                <div class="div-input">
                    <input class="input" type="text" name="name" placeholder="Enter your name" required>
                </div>
            </div>

            <div class="info-field">
                <label class="label">
                    * Email:
                </label>
                <div class="div-input">
                    <input class="input" type="text" name="email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="info-field">
                <label class="label">
                    * Age:
                </label>
                <div class="div-input">
                    <input class="input" type="number" name="age" placeholder="Age" required>
                </div>
            </div>

            <div class="info-field">
                <label class="label">
                    Which option best describes your current occupation ?
                </label>
                <div class="div-input">
                    <select name="occupation" id="occupation">
                        <option value="full time">Full Time</option>
                        <option value="part time">Part Time</option>
                    </select>
                </div>
            </div>

            <div class="info-field">
                <label>
                    Which option best describes your current occupation ?
                </label>
                <div class="div-input">
                     <input  type="radio" id="type" name="type" value="search engine">
                     <label for="search-engine">Search engine</label><br>
                    <input  type="radio" id="facebook" name="type" value="facebook">
                    <label for="facebook">Facebook</label><br>
                    <input  type="radio" id="word-of-mouth" name="type" value="word of mouth">
                    <label for="word-of-mouth">Word of mouth</label>
                    <input  type="radio" id="other" name="type" value="other">
                    <label for="other">Other</label>
                </div>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
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
