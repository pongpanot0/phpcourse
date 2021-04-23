<?php
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        require_once 'config.php';

        $sql = "SELECT * FROM emplotees WHERE id =?";
        if (stmt = mysqli_prepare($link,$sql)) {
            mysqli_stmt_bind_param($stmt,"i",$param_id);
            $param_id= trim($_GET["id"]);
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result)==1){
                    $row =mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $name =$row["name"];
                    $add = $row["add"];
                    $salary = $row["salary"];
                } else  {
                    header ("location :index.php");
                    exit();
                }
            } else {
                echo "Oops!";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        header("location:error.php");
        exit();

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>ReadPage</title>
    <style>
    .warpper {
        width :500px;
        margin :0 auto;

    }
    </style>
</head>
<body>
    <div class="warpper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1> View record</h1>
                    </div>
                    <div class="form-group">
                        <labe>Name</labe>
                        <p class="form-control-static"><?php echo $row["name"]?></p>
                    </div>
                    <div class="form-group">
                        <labe>add</labe>
                        <p class="form-control-static"><?php echo $row["add"]?></p>
                    </div>
                    <div class="form-group">
                        <labe>salary</labe>
                        <p class="form-control-static"><?php echo $row["salary"]?></p>
                    </div>
                    <p><a herf="index.php" class="btn btn-primary">back</a></p>
                </div>
            </div>
        </div>
    </div>    

</body>
</html>