<?php
    require_once '../classes/Database.class.php';

    $Db = new Database();

    if (isset($_POST['action']) && $_POST['action'] == "view")
    {
        $output = '';
        $data = $Db->getData();

        if ($Db->totalRow()>0) {
            $output .= '<table class="table table-striped table-md table-bordered">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>NOM</th>
                    <th>DESCRIPTION</th>
                    <th>PRIX</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>';

            foreach ($data as $row) {
                $output .= '<tr class="text-center text-secondary">
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name_product'] . '</td>
                    <td>' . $row['description_product'] . '</td>
                    <td>' . $row['price_product'] . '</td>
                    <td>
                        <a href="#" title="Voir les détails" class="btn btn-success infoBtn" id="' . $row['id'] . '">
                            <i class="fas fa-info-circle fa-lg"></i>
                        </a>
                        <a href="#" title="Modifier produit" class="btn btn-primary editBtn" data-bs-toggle="modal" data-bs-target="#EditModal" id="' . $row['id'] . '">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <a href="#" title="Suprimer produit" class="btn btn-danger deleteBtn" id="' . $row['id'] . '">
                            <i class="fas fa-trash-alt fa-lg"></i>
                        </a>
                    </td>
                    </tr>';
            }

            $output .= '</tbody></table>';

            echo $output;
        }
        else {
            '<h3 class="text-center text-secondary mt-5">Aucune Donnée Trouvée</h3>';
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert")
    {
        $product = $_POST['product'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $Db->insertData($product, $description, $price);
    }

    if (isset($_POST['edit_id']))
    {
        $id = $_POST['edit_id'];

        $row = $Db->getDataById($id);
        echo json_encode($row);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update")
    {
        $id = $_POST['id'];
        $product = $_POST['product'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $Db->updateData($id, $product, $description, $price);
    }

    if (isset($_POST['delete_id']))
    {
        $id = $_POST['delete_id'];

        $Db->deleteData($id);
    }

    if (isset($_POST['info_id']))
    {
        $id = $_POST['info_id'];

        $row = $Db->getDataById($id);

        echo json_encode($row);
    }

    if (isset($_GET['export']) && $_GET['export'] == "excel") {
        header("Content-Type: application/xml");
        header("Content-Disposition: attachement; filename=user.xml");
        header("Pragma: no-cache");
        header("Expires: 0");

        $data = $Db->getData();

        echo '<table border="1">';
        echo '<tr> <th>ID</th> <th>PRODUIT</th> <th>DESCRIPTION</th> <th>PRIX</th> <tr>';

        foreach ($data as $row)
        {
            echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['product'] . '</td>
                <td>' . $row['description'] . '</td>
                <td>' . $row['price'] . '</td>
            </tr>';
        }

        echo '</table>';
    }

?>
