<div class="modal fade" id="AddNewProfile" tabindex="-1" role="dialog" aria-labelledby="AddNewProfile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addform">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $config["Text"]["Close-btn"]; ?></span></button>
                    <h4 class="modal-title" id="meinModalLabel"><?php echo $config["Text"]["New-profile"]; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3"><input class="form-control" type="text" required name="vorname" placeholder="<?php echo $config["Text"]["Firstname"]; ?>" autofocus></div>
                        <div class="col-lg-3"><input class="form-control" type="text" required name="nachname" placeholder="<?php echo $config["Text"]["Lastname"]; ?>"></div>
                        <div class="col-lg-3"><input class="form-control" type="email" required name="email" placeholder="<?php echo $config["Text"]["E-mail"]; ?>"></div>
                        <div class="col-lg-3"><input class="form-control" type="password" required name="passwort" placeholder="<?php echo $config["Text"]["Password"]; ?>"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $config["Text"]["Close-btn"]; ?></button>
                    <button type="submit" class="btn btn-primary save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!" data-dismiss="modal"><?php echo $config["Text"]["Save-btn"]; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
