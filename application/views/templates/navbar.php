<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 2016-09-29
 * Time: 11:07
 */
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapsable" aria-expanded="false">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/seminar">Seminarų sistema</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapsable">
            <ul class="nav navbar-nav">
                <li class="<?php echo $page == 'seminar' ? 'active' : '' ?>"><a href="/seminar">Sąrašas</a></li>
                <?php if ($this->ion_auth->is_admin()) { ?>
                    <li class="<?php echo $page == 'seminar/create' ? 'active' : '' ?>"><a href="/seminar/create">Naujas
                            seminaras</a></li>
                    <li class="<?php echo $page == 'auth/users' ? 'active' : '' ?>"><a href="/auth/users">Sistemos vartotojai</a></li>
                    <li class="<?php echo $page == 'email' ? 'active' : '' ?>"><a href="/email">Naujienlaiškiai</a></li>
                    <li class="<?php echo $page == 'email/newsletter' ? 'active' : '' ?>"><a href="/email/newsletter">Naujas naujienlaiškis</a></li>
                <?php } ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (!$this->ion_auth->logged_in()) {
                    ?>
                    <li><a href="/auth/register">Registruotis</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Prisijungti</b> <span
                                class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">

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
                                            <!--<div class="help-block text-right"><a href="">Pamiršote slaptažodį ?</a></div>-->
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
                                        <?php echo form_hidden('redirect', uri_string()); ?>
                                        <div class="form-group">
                                            <?php echo form_submit('submit', 'Jungtis', 'class="btn btn-primary btn-block"'); ?>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a><i class="fa fa-user"></i> <?php echo $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name; ?></a>
                    </li>
                    <li><a href="/auth/logout"><?php echo $this->lang->line('logout_label'); ?></a></li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
