<!DOCTYPE html>
<html>
<head>
    <title>User Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .data{
          
          border: 2px solid white;
         background-color: white;
         padding: 60px;
         font-size: 30px;
        
          }
          #but{
            width: 150px;
             height:60px;
             background-color:green;
             font-size:20px;
             border:0;
             color:white;
             position: fixed;
            top: 120px;
            right: 20px;
            transform: translateX(-50%);
          }
    </style>
</head>
<body>
    
<input type="button" id="but" value="Add New User" onclick="goToForm()">

              
    <div class="data">
        <h1 style="text-decoration: underline;">User Details</h1>
        <?php
        if (isset($_GET['data'])) {
            $data = unserialize(urldecode($_GET['data']));
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Gender</th><th>Mail Status</th></tr>";
            foreach ($data as $row) {
                echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['Gender'] . "</td><td>" . $row['Mail_status'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data to display</p>";
        }
        ?>
    </div>
     <script>
        function goToForm() {
            window.location.href = "lab.php";
        }
    </script>
</body>
</html>