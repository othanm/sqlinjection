<html>
    <body>
        <form action="#" method="post">
            <input type="text" name="name" id=""> <br><br>
            <input type="email" name="email" id=""> <br><br>
            <input type="password" name="password" id=""> <br><br>
            <input type="submit" name="submit" value="login"> <br><br>
        </form>
    </body>
</html>

<?php 
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="dbhomework";

    $conn = mysqli_connect( $servername,$username, $password,$dbname);

    if(mysqli_connect_error()){
        echo "connection erorr";
    }else{
        // echo "connection successed";

       
        if(isset($_POST['submit'])){
            $username=$_POST['name']; $email=$_POST['email']; $password=$_POST['password'];
            $sql="select * from users where username=? and email=? and password=?";

            $sql=mysqli_prepare($conn,$sql);                  //للحماية من ال sql injecton
            mysqli_stmt_bind_param($sql,"sss",$username,$email,$password);
            mysqli_stmt_execute($sql);
            $res=mysqli_stmt_get_result($sql);
            
            if($res && $res->num_rows>0){              
                header("location:welcom.php");                                       //رح يفوت على الصفحة فقط
                echo "valid user";                             //لما اعطيه بيانات الناس الموجودة بالداتا بيز   
                                                                //(othman , othman@gmail.com , 123) 
             }else{
                echo "invalid user". mysqli_error($conn);
            }
        }
    }

?>