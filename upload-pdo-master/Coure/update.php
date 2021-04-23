<?php
  
    require_once 'config.php';
    $name = $add = $salary = "";
    $name_err = $add_err = $salary_err = "";
    if(isset($_POST["id"]) && !empty($_POST["id"])) {
        //get hidden input
        $id = $_POST["id"];
        //validate name
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "Please enter a name.";
        } elseif (!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z'-.\s]+$/")))) {
            $name_err = "please enter a valid name.";
        } else {
            $name = $input_name;
        }
             //validate add
        $input_add = trim($_POST["add"]);
        if (empty($input_add)) {
            $add_err = "Please enter an address.";
        } else {
            $add = $input_add;
        }
             // validate salary
        $input_salary = trim($_POST["salary"]);
        if (empty($input_salary)) {
            $salary_err = "Plase enter salary";
        } else {
            $salary = $input_salary;
        }
    // check input error 
    if(empty($name_err) && empty($add_err) && empty($salary_err)) {
        $sql ="UPDATE emplotees SET name=?, add=?,salary=? WHERE id=?";
        if ($stmt = mysqli_prepare($link,$sql)) {
            mysqli_stmt_bind_param($stmt,sssi,$param_name,$param_add,$param_salary,$param_id);
            $param_name = $name;
            $param_add = $add;
            $param_salary =$salary;
            $param_id =$id;
            if(mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            } else {
                echo "Someting wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    } else {
        //check exist id 
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            //get url
            $id =trim($_GET["id"]);
            // prepare a select statement
            $sql ="SELECT * FROM emplotees WHERE id=?";
            if(stmt = mysqli_prepare($link,$sql)) {
                mysqli_stmt_bind_param($stmt,"i",$param_id);
                //set param
                $param_id =$id;
                if(mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_row($result)==i){
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $name= $row["name"];
                        $add =$add["add"];
                        $salary =$row["salary"];
                    } else {
                        header("location: error.php");
                        exit();
                    }
                } else {
                    echo "Oops!!";
                }
            }
            // close stmt
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            header("location :error.php");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
    <style>
    .wrapper {
        width: 500px;
        margin : 0 auto;

    }
    </style>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
     <div class="warpper">
     <div class="container-fluid">
     <div class="row">
     <div class="col-md-12">
     <div class="page-header">
     <h2>  creat Record  </h2>
     </div>
     <p>please fill the form</p>
     <from action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
     <div class="form-group <?php echo(!empty($name_err))?'has-error':'';?>">
        <label>name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
        <span class="help-block"> <?php echo $name_err;?> </span>
     </div>
     <div class="form-group <?php echo(!empty($add_err))?'has-error':'';?> ">
        <label>add</label>
        <textarea  name="add" class="form-control" value=""><?php echo $add;?> </trxtarea>
        <span class="help-block"> <?php echo $add_err;?> </span>
     </div>    
     <div class="form-group <?php echo(!empty($salary_err))?'has-error':'';?> ">
        <label>salary</label>
        <input type="text" name="salary" class="form-control" value="<?php echo $salary;?>">
        <span class="help-block"><?php echo $salary_err; ?></span>
     </div>
     <input type="hidden" name="id" value="<?php echo $id; ?>">
     <input type="submit" class="btn btn-primary" value="submit">
     <a herf="index.php" class="btn btn-default">cancel</a>
     </from>
     </div>
     </div>
     </div>
     </div>
</body>
</html>