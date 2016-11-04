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
            $attributes = array('role' => 'form', 'id' => 'register');
            echo form_open('auth/register', $attributes);
            ?>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'first_name',
                    'type' => 'text',
                    'id' => 'first_name',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('edit_user_fname_label'),
                    'value' => set_value('first_name'),
                );
                echo form_label($this->lang->line('edit_user_fname_label'), 'first_name', 'class="sr-only"');
                echo form_error('first_name', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'last_name',
                    'type' => 'text',
                    'id' => 'last_name',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('edit_user_lname_label'),
                    'value' => set_value('last_name'),
                );
                echo form_label($this->lang->line('edit_user_lname_label'), 'last_name', 'class="sr-only"');
                echo form_error('last_name', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'email',
                    'type' => 'email',
                    'id' => 'email',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('create_user_email_label'),
                    'value' => set_value('email'),
                );
                echo form_label($this->lang->line('create_user_email_label'), 'email', 'class="sr-only"');
                echo form_error('email', '<div class="alert alert-danger" role="alert">', '</div>');
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
                    'placeholder' => $this->lang->line('create_user_password_label'),
                    'value' => '',
                );
                echo form_label($this->lang->line('create_user_password_label'), 'password', 'class="sr-only"');
                echo form_error('password', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <?php
                $data = array(
                    'name' => 'confirmPassword',
                    'type' => 'password',
                    'id' => 'confirmPassword',
                    'class' => 'form-control',
                    'placeholder' => $this->lang->line('create_user_password_confirm_label'),
                    'value' => '',
                );
                echo form_label($this->lang->line('create_user_password_confirm_label'), 'confirmPassword', 'class="sr-only"');
                echo form_error('confirmPassword', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($data);
                ?>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php
                        $data = array(
                            'name' => 'newsletter',
                            'id' => 'newsletter',
                            'value' => '1',
                            'checked' => FALSE,
                        );
                        echo form_checkbox($data); ?> Sutinku gauti naujienlaiškį</label>
                </div>
            </div>
            <div class="form-group">
                <?php echo form_submit('submit', $this->lang->line('create_user_submit_btn'), 'class="btn btn-primary btn-block"');?>
            </div>
            <?php echo form_close();?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


