<!DOCTYPE html>
<html>
<head>
    <title>Social Media Registration</title>
</head>
<body>

<h2>Social Media Registration Form</h2>

<form method="post">
    Full Name:
    <input type="text" name="name"><br><br>

    username:
    <input type="text" name="username"><br><br>

    Email:
    <input type="text" name="email"><br><br>

    Mobile Number:
    <input type="number" name="mobile"><br><br>

    Age:
    <input type="number" name="age"><br><br>

    Password:
    <input type="password" name="password"><br><br>

    Confirm Password:
    <input type="password" name="confirm_password"><br><br>

    Gender:
    <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="female">Female
    <br><br>

    Country:
    <select name="country">
        <option value="">--Select Country--</option>
        <option value="India">India</option>
        <option value="USA">USA</option>
        <option value="UK">UK</option>
    </select>
    <br><br>

    Bio:
    <textarea name="bio"></textarea><br><br>

    <input type="checkbox" name="terms">I agree to terms and conditions <br><br>

    <input type="submit" name="submit" value="register">
</form>

<?php
if (isset($_POST["submit"])) {
    $name       = trim($_POST["name"]);
    $username   = trim($_POST["username"]);
    $email      = trim($_POST["email"]);
    $mobile     = trim($_POST["mobile"]);
    $age        = trim($_POST["age"]);
    $password   = $_POST["password"];
    $confirm    = $_POST["confirm_password"];
    $gender     = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $country    = $_POST["country"];
    $bio        = trim($_POST["bio"]);
    $terms      = isset($_POST["terms"]);
}

if(empty($name)) {
    echo "Name is required";
}
elseif(!preg_match("/^[a-zA-Z ]+$/",$name)){
    echo "Name should contain only letters";
}
elseif(empty($username)) {
    echo "Username is required";
}
elseif(!preg_match("/^[a-zA-Z0-9]+$/",$name)){
    echo "Username should contain only letters and numbers";
}
elseif(empty($email)) {
    echo "email is required";
}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Invaild email format";
}
elseif(empty($mobile)) {
    echo "Enter mobile number";
}
elseif(!preg_match("/^[0-9]{10}$/",$mobile)){
    echo "mobile number must be 10 digits";
}
elseif(empty($age)) {
    echo "Enter the age";
}
elseif($age <13 || $age >60){
    echo "Age should be between 13 and 60";
}
elseif(empty($password)) {
    echo "Password is required";
}
elseif(strlen($password) < 8) {
    echo "Password must be atlest 8 characters";
}
elseif(empty($confirm)) {
    echo "Confirm Password is required";
}
elseif($password != $confirm ) {
    echo "Passwords doesn't match";
}
elseif(empty($gender)) {
    echo "Please select gender";
}
elseif(empty($country)) {
    echo "Please select country";
}
elseif(strlen($bio) < 10) {
    echo "Bio must be atleast 10 characters";
}
elseif(!$terms) {
    echo "You must accept terms and conditions";
}
else{
    echo "Registration Successfull";
}

?>
</body>
</html>