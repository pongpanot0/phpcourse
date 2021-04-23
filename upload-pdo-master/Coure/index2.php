<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .wrapper{
            width:650px;
            margin:0 auto;
        }
        .page-header h2{
            margin-top:0;
        }
        table tr td:last-child a{
            margin-right : 15px;
        }
    </style>
    <script>
        $(document).ready(function()
        {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
</head>
<body>
        <div class="wrapper">
            <div class="container-fuild">
                <div class="row">
                    <div class="col md-12">
                        <div class="page-hearder">
                            <h2 class="pull-left">Employees Detail</h2>
                            <a herf="creat.php" class="btn btn-success pull-right">
                                add new employees
                            </a>
                        </div>
                        <?php
                        require_once 'config.php';
                        $sql = "SELECT * FROM employees";
                        if ($result = mysqli_query($link)) {
                            if(mysql_num_rows($result) > 0 ){
                                echo "<table class='table table-bordered table-striped'> ";
                                echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>name</th>";
                                    echo "<th>add</th>";
                                    echo "<th>salary</th>";
                                    echo "<th>action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while(row = mysqlifetch_array ($result)) {
                                        echo "<tr>";
                                        echo "<td>" .$row['id'] . "</td>";
                                        echo "<td>" .$row['name'] . "</td>";
                                        echo "<td>" .$row['add'] . "</td>";
                                        echo "<td>" .$row['salary'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='read.php ?id=" . $row ['id']."'  title ='view record' 
                                        data-toggle='tooltip'<span class='glyhicon glyhicon-eye-open'></span>></a>";
                                        echo "<a href='read.php ?id=" . $row ['id']."'  title ='view record' 
                                        data-toggle='tooltip'<span class='glyhicon glyhicon-eye-open'></span>></a>";
                                        echo "<a href='read.php ?id=" . $row ['id']."'  title ='view record' 
                                        data-toggle='tooltip'<span class='glyhicon glyhicon-eye-open'></span>></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                echo "</table>";
                                mysqli_free_result($result);
                            } else {
                                echo "<p class='lead'><em>No record Found</em> </p>";
                            }
                        }
                        mysql_close($link);
                        ?>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>