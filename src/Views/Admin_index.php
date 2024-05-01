
<?php
    require_once("Admin_header.php")
?>

<!DOCTYPE html>
<html lang="en">

<body id="reportsPage">

     
<div class="row tm-content-row">
    <div class="col-12 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
            <h2 class="tm-block-title">Orders List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ORDER NO.</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">OPERATORS</th>
                        <th scope="col">LOCATION</th>
                        <th scope="col">DISTANCE</th>
                        <th scope="col">START DATE</th>
                        <th scope="col">EST DELIVERY DUE</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                    &copy; <b><?php echo $currentYear; ?></b> All rights reserved. 
                </p>
            </div>
        </footer>
    </div>

    <script src="../assests/admin_assests/js/jquery-3.3.1.min.js"></script>

