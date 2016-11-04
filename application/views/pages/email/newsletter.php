<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 11/4/2016
 * Time: 14:44
 */
?>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <h1><?php echo $headTitle ?>:</h1>
        <?php if(isset($email['id']))
        {
            $page=$page.'/'.$email['id'];
        }
        echo form_open($page); ?>
        <div class="form-group required">
            <?php
            $data = array(
                'name' => 'title',
                'id' => 'title',
                'class' => 'form-control',
                'placeholder' => 'Pavadinimas',
                'value' => set_value('title', isset($email['title']) ? $email['title'] : ''),
            );
            echo form_label('Pavadinimas:', 'title');
            echo form_error('title', '<div class="alert alert-danger" role="alert">', '</div>');
            echo form_input($data);
            ?>
        </div>
        <div class="form-group required">
            <?php
            $data = array(
                'name' => 'newsletter',
                'id' => 'newsletter',
                'class' => 'form-control',
                'rows' => '4',
                'placeholder' => 'Naujienlaiškis',
                'value' => set_value('newsletter', isset($email['newsletter']) ? $email['newsletter'] : ''),
            );
            echo form_label('Naujienlaiškis:', 'newsletter');
            echo form_error('newsletter', '<div class="alert alert-danger" role="alert">', '</div>');
            echo form_textarea($data);
            ?>
        </div>
        <div class="form-group">
            <?php echo form_submit('submit', 'Išsaugoti', 'class="btn btn-primary btn-block"'); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
