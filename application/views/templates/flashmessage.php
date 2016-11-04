<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/15/2016
 * Time: 18:39
 */
?>


<div class="container-fluid">
    <?php if ($this->session->flashdata('message_success')) { ?>
        <div class="alert alert-success"> <?php echo $this->session->flashdata('message_success'); ?> </div>
    <?php }
    if ($this->session->flashdata('message_error')) { ?>
        <div class="alert alert-danger"> <?php echo $this->session->flashdata('message_error'); ?> </div>
    <?php } ?>
</div>
