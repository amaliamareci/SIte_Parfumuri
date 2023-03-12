<?php

include_once '../../api/config/config.php';
include_once "../parfumes/product_template.php";
include_once "../../api/repository/ProductRepository.php";
include_once "../../api/repository/SoldRepository.php";
require_once '../../vendor/autoload.php';
require('fpdf.php');

class PDF extends FPDF
{
    function createTable($header, $data)
    {

        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $h) {
            $this->Cell(60, 7, $h, 1);
        }
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(60, 7, $col, 1);
            }
            $this->Ln();
        }
    }
}

if ($_POST['formType'] == 'stock') {
    $productRepository = new ProductRepository();
    $products = $productRepository->getStockRaport($_POST['formGender'], $_POST['formCategory']);
} else {
    $soldRepository = new SoldRepository();
    $products = $soldRepository->getSoldRaport($_POST['formGender'], $_POST['formCategory'], date("Y-m-d"));
}
$title = $_POST['formFormat'] . " Raport - " . $_POST['formType'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Raport</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/filter.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/products.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/product.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/heart.css">
</head>

<body>
    <?php include_once "../header.php" ?>

    <h1><?php echo $title; ?></h1>

    <?php
    if ($_POST["formFormat"] == "HTML") {
        if ($products[0] != null) {
            echo " <table><tr>
                        <th>Nume</th>
                        <th>Cantitate</th>
                        </tr>";
            for ($i = 0; $i < count($products); $i += 2)
                if ($products[$i] != "NULL") {
                    echo '<tr>';
                    echo '<td>' . $products[$i] . '</td>';
                    echo '<td>' . $products[$i + 1] . '</td>';
                    echo '</tr>';
                }
            echo "</table>";
        } else
            echo '<h1>Nici un rezultat !</h1>';
    } else if ($_POST["formFormat"] == "JSON") {
        if ($products[0] != null) {
            echo "<pre>{\n";
            for ($i = 0; $i < count($products); $i += 2)
                if ($products[$i] != "NULL") {
                    echo "\t{\n";
                    echo "\t\t\"nume\":\"" . $products[$i] . "\",\n";
                    echo "\t\t\"cantitate\":" . $products[$i + 1] . "\n";
                    echo "\t},\n";
                }
            echo "}</pre>";
        } else
            echo '<h1>Nici un rezultat !</h1>';
    } else if ($_POST["formFormat"] == "PDF") {
        ob_end_clean();
        $pdf = new PDF();
        $pdf->AddPage();
        //Table Header
        $header = ["Nume", "Cantitate"];
        //Table Rows
        $data = [];
        if ($products[0] != null) {
            for ($i = 0; $i < count($products); $i += 2)
                if ($products[$i] != "NULL") {
                    $current = [$products[$i], $products[$i + 1]];
                    array_push($data, $current);
                }
        } else
            echo '<h1>Nici un rezultat !</h1>';

        $pdf->createTable($header, $data);
        $pdf->Output();
    }

    ?>

    <br><br><br>
    <?php include_once "../footer.html" ?>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/filter.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>

</html>