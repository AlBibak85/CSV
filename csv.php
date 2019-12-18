<?php
$message='';

if (isset($_SESSION['message'])){
    $message=$_SESSION['message'];
    unset($_SESSION['message']);
}

$conn=mysqli_connect("localhost","root","","csv");

if (isset($_POST['btn'])){

    $fileName= $_FILES['file']['tmp_name'];

        $fp=fopen($fileName,"r");
        while (($data=fgetcsv($fp))!=false){

            $sql="INSERT INTO tbl_csv(Segment,Country)VALUES('$data[0]','$data[1]')";
            $result=mysqli_query($conn,$sql);

        }

    $startTime=microtime(true);
    $result=mysqli_query($conn,$sql);
    $endTime=microtime(true);
    $endTime=$startTime-$endTime;

    echo $endTime;

    if (!empty($result)){
        session_start();
        $_SESSION['message']="data csv import and save database";
    }else{
        echo "error";
    }


}


?>

<html>
<head>
    <link rel="stylesheet" href="asset/css/bootstrap.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="offset-3 col-md-6">

            <div style="margin-top: 100px">
                <form action="" method="post" enctype="multipart/form-data">

                    <input class="form-control" type="file" name="file">
                    <button type="submit" name="btn" class="btn btn-success form-control">Import</button>
                </form>
                <h5 class="text-center text-danger"><?php echo $message;?></h5>
            </div>


        </div>

    </div>
</div>

</body>

<script src="asset/js/bootstrap.min.js"></script>


</html>

