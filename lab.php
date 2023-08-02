<!DOCTYPE html>
<html>
<head>
    <title>User Registration Form</title>
    <style>
        
        #name {
            width: 350px;
            height: 20px;
        }
        #email {
            width: 350px;
            height: 20px;
        }
        .formm{
          
        border: 2px solid white;
       background-color: white;
       padding: 60px;
       font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="formm">
    <h1 style="text-decoration: underline;">User Registration Form</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Please fill out this form and submit to add user record to the database</label><br><br>
        <label style="font-size: 30px;">Name:</label><br>
        <input type="text" name="name" id="name"><span style="color:red;font-size:20px;">*</span><br>
        <label style="font-size: 30px;">Email:</label><br>
        <input type="text" name="email" id="email"><span style="color:red;font-size:20px;">*</span><br><br>
        <label style="font-size: 30px;">Gender:</label><br><br>
        <input type="radio" name="gender" value="male">Male<br>
        <input type="radio" name="gender" value="female">Female <span style="color:red; font-size:20px;">*</span><br><br>
        <input type="checkbox" id="myCheckbox" name="mailbox" value="1">
        <label>Receive E-Mails from us.</label><br><br>
        <input style="width: 100px; height:60px; background-color:DodgerBlue; font-size:20px;" type="submit" value="Submit">
        <input style="width: 100px; height:60px;background-color:white;font-size:20px;" type="button" value="Cancel" onclick="goToHome()">
    </form>
    </div>
    <?php
    include("conn.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbname = $_POST["name"];
        $dbemail = $_POST["email"];
        $dbgender = isset($_POST["gender"]) ? $_POST["gender"] : "";
        $dbmail = isset($_POST["mailbox"]) ? "Yes" : "No";
        if ($dbemail == "" || $dbname == "" || $dbgender == "") {
            echo '<script> alert ("Empty Field")</script>';
        } elseif (!filter_var($dbemail, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert ("Invalid email")</script>';
        } else {
            $sql = "INSERT INTO Users (Name, Email, Gender, Mail_status) VALUES ('$dbname', '$dbemail', '$dbgender', '$dbmail')";
            //execute SQL query using mysqli_query
            if (mysqli_query($conn, $sql)) {
                // select all rows from Users and put result to $result
                $result = mysqli_query($conn, "SELECT * FROM Users");
                //initialize empty array to store fetched rows
                $data = array();
                //fetches each row from result and put it to $row ,The loop continues until there are no more rows to fetch
                while ($row = mysqli_fetch_assoc($result)) {
                    // insert fetched rows to $data array
                    $data[] = $row;
                }
               // mysqli_free_result($result);
                mysqli_close($conn);
                // redirect the user to the "userData.php" page
                //serializes the $data array into  string and URL encodes it to pass the array data as a query parameter in the URL 
                //and then userData.php retrive anddeserialize the data to use it

                header("Location: userData.php?data=".urlencode(serialize($data)));
                exit();
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '")</script>';
            }
        }
        mysqli_close($conn);
    }
    ?>
     <script>
        function goToHome() {
            window.location.href = "home.html";
        }
    </script>
</body>
</html>



