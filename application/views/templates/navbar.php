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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapsable" aria-expanded="false">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Seminarų sistema</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapsable">
            <ul class="nav navbar-nav">
                <li class="<?php echo $page=='seminar'?'active':'' ?>"><a href="/seminar">Sąrašas</a></li>
                <?php if($is_admin){ ?><li class="<?php echo $page=='users'?'active':'' ?>"><a href="/admin">Administravimas</a></li><?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/register">Registruotis</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Prisijungti</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group">
                                            <label class="sr-only" for="email">E-paštas</label>
                                            <input type="email" class="form-control" id="email" placeholder="E-paštas" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Slaptažodis</label>
                                            <input type="password" class="form-control" id="password" placeholder="Slaptažodis" required>
                                            <div class="help-block text-right"><a href="">Pamiršote slaptažodį ?</a></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="url" id="backURL" hidden>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Jungtis</button>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> prisiminti mane
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
