<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 12:20
 */
?>
<div class="container">

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
            $attributes = array('role' => 'form', 'id' => 'login');
            echo form_open('auth/login', $attributes);
            ?>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'identity',
                    'type' => 'email',
                    'id' => 'email',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('login_identity_email_label'),
                    'value' => '',
                );
                echo form_label($this->lang->line('login_identity_email_label'), 'identity', 'class="sr-only"');
                echo form_error('identity', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'password',
                    'type' => 'password',
                    'id' => 'password',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('login_password_label'),
                    'value' => '',
                );
                echo form_label($this->lang->line('login_password_label'), 'password', 'class="sr-only"');
                echo form_error('password', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php
                        $data = array(
                            'name' => 'remember',
                            'id' => 'remember',
                            'value' => '1',
                            'checked' => FALSE,
                        );
                        echo form_checkbox($data); ?>Prisiminti mane</label>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_submit('submit', $this->lang->line('login_submit_btn'), 'class="btn btn-primary btn-block"');?>
            </div>
            <?php echo form_close();?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


