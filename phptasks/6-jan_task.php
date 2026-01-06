<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Employee Details</h2>

    <?php
    $Employee = [
        [
            "name" => "ABC",
            "basicSalary" => 50000
        ],
        
        [
            "name" => "XYZ",
            "basicSalary" => 70000
        ]
    ];

    foreach ($Employee as $emp){
        $HRA = 0.2 * $emp["basicSalary"];
        $DA = 0.1 * $emp["basicSalary"];
        $totalSalary = $emp["basicSalary"] + $HRA + $DA;
        echo "<b>","Employee Name : ".$emp["name"],"</b>"."<br>";
        echo "Basic salary : ".$emp["basicSalary"]."<br>";
        echo "HRA : ".$HRA."<br>";
        echo "DA : ".$DA."<br>";
        echo "Total Salary : ".$totalSalary."<br>";
        echo "<hr>";
    }
    ?>
</body>
</html>