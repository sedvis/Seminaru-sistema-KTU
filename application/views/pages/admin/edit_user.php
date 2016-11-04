<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/16/2016
 * Time: 20:35
 */

?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <?php
            $attributes = array('role' => 'form', 'id' => 'edi_user');
            echo form_open('auth/edit_user/' . $user->id, $attributes);

            ?>


            <div class="form-group">
                <?php
                echo form_label($this->lang->line('edit_user_fname_label'), 'first_name', 'class="sr-only"');
                echo form_error('first_name', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($first_name);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label($this->lang->line('edit_user_lname_label'), 'last_name', 'class="sr-only"');
                echo form_error('last_name', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($last_name);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label($this->lang->line('create_user_password_label'), 'password', 'class="sr-only"');
                echo form_error('password', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($password);
                ?>
            </div>
            <div class="form-group">
                <?php
                echo form_label($this->lang->line('create_user_password_confirm_label'), 'confirmPassword', 'class="sr-only"');
                echo form_error('confirmPassword', '<div class="alert alert-danger" role="alert">', '</div>');
                echo form_input($confirmPassword);
                ?>
            </div>

            <?php if ($this->ion_auth->is_admin()): ?>

                <div class="form-group">
                    <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                    <?php foreach ($groups as $group): ?>
                        <div class="checkbox">
                            <label>
                                <?php
                                $gID = $group['id'];
                                $checked = null;
                                $item = null;
                                foreach ($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked = ' checked="checked"';
                                        break;
                                    }
                                }
                                ?>
                                <input type="checkbox" name="groups[]"
                                       value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <?php echo form_hidden('id', $user->id); ?>

            <div class="form-group">
                <p><?php echo form_submit('submit', 'Išsaugoti vartotoją', 'class="btn btn-primary btn-block"'); ?></p>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
