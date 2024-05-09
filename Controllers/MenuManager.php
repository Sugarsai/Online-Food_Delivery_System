<?php
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;
use mysqli;

class MenuManager{
    private $db;
    private $temp;
    private $store;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function addDish(array $formdata): string
    {
        $message = '';
        if (isset($_POST['submit'])) {
          $message =  $this->validateDishForm($formdata);
        }
        return $message;
    }

    private function validateDishForm(array $formdata):string
    {
        if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>All fields Must be Fillup!</strong>
                            </div>';
                            return $error;
        } else {
           return $this->processDishUpload($formdata);
        }
    }

    private function processDishUpload(array $formdata): string
    {
        $fname = $_FILES['file']['name'];
        $this->temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));
        $fnew = uniqid() . '.' . $extension;
        $this->store = "Res_img/dishes/" . basename($fnew);

        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($fsize >= 1000000) {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Max Image Size is 1024kb!</strong> Try different Image.
                                    </div>';
                                    return $error;
            } else {
                return $this->insertDishToDatabase($formdata,$fnew);
            }
        } elseif ($extension == '') {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>select image</strong>
                                    </div>';
                                    return $error;
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>invalid extension!</strong>png, jpg, Gif are accepted.
                                    </div>';
                                    return $error;
        }
    }

    private function insertDishToDatabase(array $formdata,string $newFilename): string
    {
        $stmt = $this->db->prepare("INSERT INTO dishes (rs_id, title, slogan, price, img) VALUES (?, ?, ?, ?, ?)");

        // Bind parameters
        $types = "issss";
        $this->db->bindParams($stmt, $types, $_POST['res_name'], $_POST['d_name'], $_POST['about'], $_POST['price'], $newFilename);

        // Execute the statement
        $this->db->execute($stmt);
        move_uploaded_file($this->temp, $this->store);

        $success = '<div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            New Dish Added Successfully.
                        </div>';
         return $success;
    }


    public function displayMenu(): void
    {
        $sql = "SELECT * FROM dishes ORDER BY d_id DESC";
        $query = $this->db->query($sql);
        

        if ($this->db->countRows($query) > 0) {
            while ($rows = mysqli_fetch_assoc($query)) {
                $shopid = (int)$rows['rs_id'];
                $fetch = $this->getRestaurantDetails($shopid);

                echo '<tr><td>'.$fetch['title'].'</td>
                        <td>'.$rows['title'].'</td>
                        <td>'.$rows['slogan'].'</td>
                        <td>$'.$rows['price'].'</td>
                        <td><div class="col-md-3 col-lg-8 m-b-10">
                                <center><img src="Res_img/dishes/'.$rows['img'].'" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
                            </div></td>
                        <td><a href="delete_menu.php?menu_del='.$rows['d_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                            <a href="update_menu.php?menu_upd='.$rows['d_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                        </td></tr>';
            }
        } else {
            echo '<td colspan="11"><center>No Menu</center></td>';
        }
    }

    private function getRestaurantDetails(int $restaurantId): array
    {
        $mql = "SELECT * FROM shop WHERE rs_id = ?";
        $stmt = $this->db->prepare($mql);
        $this->db->bindParams($stmt, "i", $restaurantId);
        $this->db->execute($stmt);
        $result = $this->db->fetchArray($stmt);

        return $result;
    }
    public function deleteRelatedMenu($restaurantID)
    {
        $query = "DELETE FROM dishes WHERE rs_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$restaurantID]);
    }
}