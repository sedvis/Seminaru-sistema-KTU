<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 12:11
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
<!--
id;
title;
date;
seats;
description;
cost;
emailTemplateID;
dateCreated;
dateLastModified;
assignedID;
-->
            <?php echo validation_errors(); ?>
            <?php echo form_open('seminar/create'); ?>
            <div class="form-group">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" id="title" placeholder="Pavadinimas">
            </div>
            <div class="form-group">
                <label for="name">Seminaro data ir laikas</label>
                <input type="datetime" class="form-control" id="date" placeholder="Data ir laikas">
            </div>
            <div class="form-group">
                <label for="name">Vietų skaičius</label>
                <input type="number" class="form-control" id="seats" placeholder="Vietų skaičius">
            </div>
            <div class="form-group">
                <label for="confirmPass">Pakartokite slaptažodį</label>
                <input type="password" class="form-control" id="confirmPass" placeholder="Slaptažodis">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Sutinku gauti naujienlaiškį
                </label>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>