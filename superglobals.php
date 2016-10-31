<?php
//In this php form we will have $GLOBALS,$REQUEST,$_ENV,$_COOKIES
//Please go to superglobals.html to see how the other superglobals work.
//$GLOBALS is used to access global variables from anywhere in the PHP script.
//In this case I can access $UCID without declaring the variable
//outside of the function.

$num1= 1;
$num2 = 10;
function myGlobal(){
  $GLOBALS['UCID'] = $GLOBALS['num1'] + $GLOBALS['num2'];
}

myGlobal();
  echo $UCID;
  echo "<br>";
//$SERVER holds information about headers, paths, and script locations.
  echo $_SERVER['PHP_SELF'];
    echo "<br>";
  echo $_SERVER['SERVER_NAME'];
    echo "<br>";
  echo $_SERVER['HTTP_HOST'];
    echo "<br>";
  echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br>";
  echo $_SERVER['SCRIPT_NAME'];
    echo "<br>";

//$REQUEST used to collect data after submitting an HTML form

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_REQUEST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}

//$_GET is an associative array of variables that is passed to the current
//script via the URL parameters. In the example shown below, we would get the name
//from another input page.


echo 'Good Morning ' . htmlspecialchars($_GET["name"]) ;

//$_POST An associative array of variables passed to the current script via the HTTP POST method
// when using application/x-www-form-urlencoded or multipart/form-data as the HTTP Content-Type in the request.

echo 'Hello!!'.htmlspecialchars($_POST["name"]);
//By using the post global here, we would get the following result
/*array (
0 => array('first_name'=>'julia','last_name'=>'garcia'),
1 => array('first_name'=>'keith','last_name'=>'williams'),
)*/

//$_FILES it is used to upload files to a page, in this case we are making our html form upload files to the current page.
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


//$_COOKIES is an associative array of variables passed to the current script via HTTP Cookies.
// In this case I am setting the cookie for user for one day

$cookie_name = "user";
$cookie_value = "Julia";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}

//$_SESSION is a superglobal used to store information in variables to be used accross multiple pages
//In this example we are starting a session and determining its values in the html file.
session_start();
//$_ENV is an associative array of variables passed to the current script via the environment method.
//In this example I am getting my user from my ssh.
echo 'My username is ' .$_ENV["USER"] . '!';
?>
