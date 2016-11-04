<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 10:23
 */
?>
<div class="container-fluid">
    <?php
    if (isset($seminars)) {
        $i = 0;
        foreach ($seminars as $seminar) {
            $joined = $this->seminar_model->is_joined($seminar['id']);
            if ($i == 0) {
                echo '<div class="row">';
            }
            ?>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $seminar['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="row">
                                <span><i class="fa fa-calendar fa-2x"> <?php echo $seminar['date']; ?></i></span>
                            </div>
                            <div class="row">
                                <span><i class="fa fa-clock-o fa-2x"> <?php echo $seminar['time']; ?></i></span>
                            </div>
                            <div class="row">
                                <span><i class="fa fa-money fa-2x">  <?php echo $seminar['cost']; ?></i></span>
                            </div>
                            <div class="row">
                                <span><i class="fa fa-users fa-2x">  <?php echo $seminar['joined_count']."/".$seminar['seats']; ?></i></span>
                            </div>
                            <div class="row">
                                <span><i class="fa fa-location-arrow fa-2x"> <?php echo $seminar['location']; ?></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <span>
                             <?php echo $seminar['description']; ?>
                        </span>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="text-right">
                            <div class="btn-group " role="group" aria-label="manipulation">
                                <?php if ($this->ion_auth->logged_in()) {
                                    if ($joined) { ?>
                                        <a href="/seminar/leave/<?php echo $seminar['id']; ?>"
                                           class="btn btn-default" data-toggle="tooltip" title="Išsiregistruoti"><i
                                                class="fa fa-2x fa-sign-out"
                                                aria-hidden="true"></i></a>
                                    <?php } else { ?>
                                        <a href="/seminar/join/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                           data-toggle="tooltip" title="Prisiregistruoti"><i
                                                class="fa fa-2x fa-sign-in"
                                                aria-hidden="true"></i></a>
                                    <?php }
                                }
                                ?>
                                <a href="/seminar/detailview/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                   data-toggle="tooltip" title="Seminaro peržiūra"><i
                                        class="fa fa-2x fa-eye"
                                        aria-hidden="true"></i></a>
                                <a href="/seminar/users/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                   data-toggle="tooltip" title="Užsiregistravę vartotojai"><i
                                        class="fa fa-2x fa-user"
                                        aria-hidden="true"></i></a>
                                <?php if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin())) { ?>
                                    <a href="/seminar/edit/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                       data-toggle="tooltip" title="Redaguoti"><i
                                            class="fa fa-2x fa-edit"
                                            aria-hidden="true"></i></a>
                                    <?php if ($this->ion_auth->is_admin()) { ?>
                                        <a href="/seminar/delete/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                           data-toggle="tooltip" title="Šalinti"  onclick="return confirm('Ar tikrai norite pašalinti seminarą?')"><i
                                                class="fa fa-2x fa-trash-o"
                                                aria-hidden="true"></i></a>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
            if ($i == 3) {
                echo '</div>';
                $i = 0;
            }
        }
        if ($i != 0) {
            echo '</div>';
        }
    }
    ?>
</div>
