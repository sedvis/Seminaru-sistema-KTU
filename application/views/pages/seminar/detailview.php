<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 9/30/2016
 * Time: 11:40 AM
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $seminar['title']; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-calendar fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Data </strong>
                            </div>
                            <div class="row">
                                <span> <?php echo $seminar['date']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-clock-o fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Laikas </strong>
                            </div>
                            <div class="row">
                                <span> <?php echo $seminar['time']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-money fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Kaina </strong>
                            </div>
                            <div class="row">
                                <span>  <?php echo $seminar['cost'] . ' €'; ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-users fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Vietų skaičius </strong>
                            </div>
                            <div class="row">
                                <span>  <?php echo $seminar['joined_count'] . "/" . $seminar['seats']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-location-arrow fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Vieta </strong>
                            </div>
                            <div class="row">
                                <span> <?php echo $seminar['location']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row">
                                <i class="fa fa-phone fa-2x"></i>
                            </div>
                            <div class="row">
                                <strong> Kontaktai </strong>
                            </div>
                            <div class="row">
                                <span> <?php echo $seminar['contact']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <span>
                             <?php echo $seminar['description']; ?>
                        </span>
                        </div>
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
                            <a href="/seminar/users/<?php echo $seminar['id']; ?>" class="btn btn-default"
                               data-toggle="tooltip" title="Užsiregistravę vartotojai"><i
                                    class="fa fa-2x fa-user"
                                    aria-hidden="true"></i></a>
                            <?php if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin())) { ?>
                                <a href="/email/reminder/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                   data-toggle="tooltip" title="Siųsti priminimus"><i
                                        class="fa fa-2x fa-envelope"
                                        aria-hidden="true"></i></a>
                                <a href="/seminar/edit/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                   data-toggle="tooltip" title="Redaguoti"><i
                                        class="fa fa-2x fa-edit"
                                        aria-hidden="true"></i></a>
                                <a href="/seminar/delete/<?php echo $seminar['id']; ?>" class="btn btn-default"
                                   data-toggle="tooltip" title="Šalinti"
                                   onclick="return confirm('Ar tikrai norite pašalinti seminarą?')"><i
                                        class="fa fa-2x fa-trash-o"
                                        aria-hidden="true"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
