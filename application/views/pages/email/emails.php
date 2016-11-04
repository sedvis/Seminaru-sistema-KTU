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
            <h1>Naujienlaiškių sąrašas:</h1>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <?php if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) { ?>
                        <th>Redagavimas</th>
                    <?php } ?>
                </tr>
                <?php
                if (sizeof($emails) > 0) {
                    foreach ($emails as $email) {
                        echo '<tr><td>' . $email['id'] . '</td>';
                        echo '<td>' . $email['title'] . '</td>';
                        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) {
                            echo '<td><a href="/email/delete/'. $email['id'].'" class="btn btn-default"
                                    data-toggle="tooltip" title="Šalinti naujienlaiškį"
                                    onclick="return confirm(\'Ar tikrai norite šalinti naujienlaiškį?\')">
                                    <i class="fa fa-ban" aria-hidden="true"></i></a>';
                            echo '<a href="/email/newsletter/'. $email['id'].'" class="btn btn-default"
                                    data-toggle="tooltip" title="Redaguoti naujienlaiškį">
                                    <i class="fa fa-edit" aria-hidden="true"></i></a>';
                            echo '<a href="/email/send/'. $email['id'] .'" class="btn btn-default"
                                   data-toggle="tooltip" title="Siųsti naujienlaiškį" onclick="return confirm(\'Ar tikrai norite siųsti naujienlaiškį?\')">
                                   <i class="fa fa-envelope" aria-hidden="true"></i></a></td></tr>';
                        }
                    }

                } else {
                    echo '<td colspan="4"> Sukurtų naujienlaiškių nėra </td>';
                }
                ?>
            </table>
        </div>
        <div class="col-md-3">

        </div>

    </div>
</div>