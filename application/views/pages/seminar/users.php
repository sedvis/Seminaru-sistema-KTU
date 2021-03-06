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
            <h1>Seminaro dalyviai:</h1>
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
                        echo '<tr><td>' . $user->id . '</td>';
                        echo '<td>' . $user->first_name . '</td>';
                        echo '<td>' . $user->last_name . '</td>';
                        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) {
                            echo '<td><a href="/seminar/users/'. $seminarID .'/kick/'. $user->id .'" class="btn btn-default"
                                    data-toggle="tooltip" title="Šalinti vartotoją"
                                    onclick="return confirm(\'Ar tikrai norite šalinti vartotoją iš seminaro?\')">
                                    <i class="fa fa-ban" aria-hidden="true"></i></a>';
                            echo '<a href="/email/reminder/'. $seminarID .'/'.$user->id.'" class="btn btn-default"
                                   data-toggle="tooltip" title="Siųsti priminimą" onclick="return confirm(\'Ar tikrai norite siųsti priminimą vartotojui - '.$user->first_name.' '.$user->last_name.'?\')">
                                   <i class="fa fa-envelope" aria-hidden="true"></i></a></td></tr>';
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