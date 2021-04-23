<?php
require_once 'config.php';
$name = $add = $salary = "";
$name_err = $add_err = $salary_err = "";
    // Processing form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // valudate name
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

    if (empty($name_err) && empty($add_err) && empty($salary_err)) {
                //prepare an insert
        $sql = "INSERT INTO employees(name,add,salary) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_add, $param_salary);

            $param_name = $name;
            $param_add = $add;
            $param_salary = $salary;
            if (mysqli_stmt_execute($stmt)) {
                header("location:index.php");
                exit();
            } else {
                echo "something went wrong.";
            }
        }
    }
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cre Rec</title>
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
     <input type="submit" class="btn btn-primary" value="submit">
     <a herf="index.php" class="btn btn-default">cancel</a>
     </from>
     </div>
     </div>
     </div>
     </div>
</body>
</html>