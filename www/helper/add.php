<div class="modal fade" id="AddNewProfile" tabindex="-1" role="dialog" aria-labelledby="AddNewProfile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addform">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
                    <h4 class="modal-title" id="meinModalLabel">Neues Profil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4"><input class="form-control" type="text" required name="vorname" placeholder="Vorname"></div>
                        <div class="col-lg-4"><input class="form-control" type="text" required name="nachname" placeholder="Nachname"></div>
                        <div class="col-lg-4"><input class="form-control" type="email" required name="email" placeholder="E-Mail"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary save-btn" data-loading-text="Wird gespeichert ..." data-complete-text="Gespeichert!">Änderungen speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>