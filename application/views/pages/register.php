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
            <form>
                <div class="alert alert-danger" role="alert">Neteisingai įvesta - * </div>
                <div class="form-group">
                    <label for="name">Vardas</label>
                    <input type="text" class="form-control" id="name" placeholder="Vardenis Pavardenis">
                </div>
                <div class="form-group">
                    <label for="email">E-paštas</label>
                    <input type="email" class="form-control" id="email" placeholder="pavardenis@gmail.com">
                </div>
                <div class="form-group">
                    <label for="pass">Slaptažodis</label>
                    <input type="password" class="form-control" id="pass" placeholder="Slaptažodis">
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
                <button type="submit" class="btn btn-default">Patvirtinti</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


