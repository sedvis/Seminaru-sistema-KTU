<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 12:11
 */

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h1>Sistemos vartotojai:</h1>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Vardas</th>
                    <th>Pavardė</th>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) { ?>
                        <th>Redagavimas</th>
                    <?php } ?>
                </tr>
                <?php
                if (sizeof($users) > 0) {
                    foreach ($users as $user) {
                        echo '<tr><td>' . $user['id'] . '</td>';
                        echo '<td>' . $user['first_name'] . '</td>';
                        echo '<td>' . $user['last_name'] . '</td>';
                        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) {
                            echo '<td><a href="/auth/delete/'. $user['id'] . '" class="btn btn-default" data-toggle="tooltip" title="Šalinti" onclick="return confirm(\'Ar tikrai norite šalinti vartotoją?\')">
                                    <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a href="/auth/edit_user/'. $user['id'] .'" class="btn btn-default">
                                    <i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" title="Redaguoti"></i></a></td></tr>';
                        }
                    }

                } else {
                    echo '<td colspan="4"> Prisiregistravusių vartotojų nėra </td>';
                }
                ?>
            </table>
        </div>
        <div class="col-md-3">

        </div>

    </div>
</div>