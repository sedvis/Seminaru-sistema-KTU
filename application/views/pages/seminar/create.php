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
            <?php if ($page == 'seminar/create')
                echo '<h1>Naujas seminaras:</h1>';
            else
                echo '<h1>Seminaro redagavimas:</h1>'; ?>
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
            <?php if ($page == 'seminar/create')
                echo form_open($page);
            else
                echo form_open($page . '/' . $id); ?>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'title',
                    'type' => 'text',
                    'id' => 'title',
                    'class' => 'form-control',
                    'placeholder' => 'Pavadinimas',
                    'value' => set_value('title', isset($seminar['title']) ? $seminar['title'] : ''),
                );
                echo form_label('Pavadinimas:', 'title');
                echo form_error('title', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'datetime',
                    'type' => 'text',
                    'id' => 'datetime',
                    'class' => 'form-control',
                    'placeholder' => 'Data ir laikas',
                    'value' => set_value('datetime', isset($seminar['date'],$seminar['time']) ? $seminar['date'] . ' ' . $seminar['time'] : ''),
                );
                echo form_label('Seminaro data ir laikas:', 'datetime');
                echo form_error('datetime', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group date" id="datetime">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'location',
                    'type' => 'text',
                    'id' => 'location',
                    'class' => 'form-control',
                    'placeholder' => 'Vieta',
                    'value' => set_value('location', isset($seminar['location']) ? $seminar['location'] : ''),
                );
                echo form_label('Vieta:', 'location');
                echo form_error('location', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'seats',
                    'type' => 'number',
                    'id' => 'seats',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => 'Vietų skaičius',
                    'value' => set_value('seats', isset($seminar['seats']) ? $seminar['seats'] : ''),
                );
                echo form_label('Vietų skaičius:', 'seats');
                echo form_error('seats', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group" id="seats">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">

                <?php
                $data = array(
                    'name' => 'cost',
                    'type' => 'number',
                    'id' => 'cost',
                    'min' => '0',
                    'step' => '0.01',
                    'data-number-to-fixed' => '2',
                    'data-number-stepfactor' => '100',
                    'class' => 'form-control currency',
                    'placeholder' => 'Kaina €',
                    'value' => set_value('cost', isset($seminar['cost']) ? $seminar['cost'] : ''),
                );
                echo form_label('Kaina:', 'cost');
                echo form_error('cost', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'contact',
                    'type' => 'text',
                    'id' => 'contact',
                    'class' => 'form-control',
                    'placeholder' => 'Kontaktinė informacija',
                    'value' => set_value('contact', isset($seminar['contact']) ? $seminar['contact'] : ''),
                );
                echo form_label('Kontaktinė informacija:', 'contact');
                echo form_error('contact', '<div class="alert alert-danger" role="alert">', '</div>');
                echo '<div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>';
                echo form_input($data);
                echo '</div>';
                ?>
            </div>
            <div class="form-group required">
                <?php
                $data = array(
                    'name' => 'description',
                    'id' => 'description',
                    'class' => 'form-control',
                    'rows' => '4',
                    'placeholder' => 'Aprašymas',
                    'value' => set_value('description', isset($seminar['description']) ? $seminar['description'] : ''),
                );
                echo form_label('Aprašymas:', 'description');
                echo form_error('description', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_textarea($data);
                ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('submit', 'Išsaugoti', 'class="btn btn-primary btn-block"'); ?>
            </div>
            <span style="color:red">*</span><span> pažymėti laukai yra privalomi</span>
            <?php echo form_close(); ?>
        </div>

        <div class="col-md-3"></div>
    </div>
</div>