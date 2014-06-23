<?php include 'header.php'; ?>


<div class="modal fade" id="besteller" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Bearbeiten</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" checked>
                    </span>
                    <li class="list-group-item">Michael</li>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" checked>
                    </span>
                    <li class="list-group-item">Thomas</li>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" checked>
                    </span>
                    <li class="list-group-item">Julian</li>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox">
                    </span>
                    <li class="list-group-item">Nikolas</li>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary save-button" data-loading-text="Wird gespeichert...">Änderungen speichern</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="page-header">
    <h1>SubConf</h1>
</div>
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="col-lg-5 col-md-5 col-sm-5 nav nav-pills nav-stacked controls">
                <div class="clearfix"><button type="button" class="btn btn-default pull-right toggle-popover" data-container="body" data-toggle="modal" data-target="#besteller">Bearbeiten</button></div>
                    
                <li><a data-toggle="tab" href="#mn"><span class="lead">Michael</span> <span class="badge pull-right">5€</span><br><small>Chicken Faijta - 30cm</small></a></li>
                <li><a data-toggle="tab" href="#th"><span class="lead">Thomas</span> <span class="badge pull-right">5€</span><br><small>Chicken Faijta - 30cm</small></a></li>
                <li><a data-toggle="tab" href="#jme"><span class="lead">Julian</span> <span class="badge pull-right">5€</span><br><small>Chicken Faijta - 30cm</small></a></li>
            </ul>
            <div class="col-lg-7 col-md-5 col-sm-5 tab-content border-left">
                <div class="tab-pane" id="mn">
                    <h3>Michael</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="lead">Brot</span>
                            <p>Honey Oat</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Größe</span>
                            <p>30cm</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Fleisch</span>
                            <p>Chicken Faijta  <span class="label label-default">Doppelt</span> <span class="label label-success">Sub des Tages</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Gemüse</span>
                            <p>Salat, Gurke, Tomate, Pepperoni</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Sauce</span>
                            <p>Sweet Onion, Chipotle Southwest <span class="label label-default">Wenig</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Extras</span>
                            <p>Salz, Pfeffer, Oregano</p>
                        </li>
                        <div><p><button type="button" class="btn btn-default pull-right clearfix">Bearbeiten</button></p></div>
                    </ul>
                </div>
                <div class="tab-pane" id="th">
                    <h3>Thomas</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="lead">Brot</span>
                            <p>Sesam</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Größe</span>
                            <p>30cm</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Fleisch</span>
                            <p>Chicken Faijta  <span class="label label-default">Doppelt</span> <span class="label label-success">Sub des Tages</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Gemüse</span>
                            <p>Salat, Gurke, Tomate, Pepperoni</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Sauce</span>
                            <p>Sweet Onion, Chipotle Southwest <span class="label label-default">Wenig</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Extras</span>
                            <p>Salz, Pfeffer, Oregano</p>
                        </li>
                        <div><p><button type="button" class="btn btn-default pull-right clearfix">Bearbeiten</button></p></div>
                    </ul>
                </div>
                <div class="tab-pane" id="jme">
                    <h3>Julian</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="lead">Brot</span>
                            <p>Italian</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Größe</span>
                            <p>15cm</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Fleisch</span>
                            <p>Chicken Faijta  <span class="label label-default">Doppelt</span> <span class="label label-success">Sub des Tages</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Gemüse</span>
                            <p>Salat, Gurke, Tomate, Pepperoni</p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Sauce</span>
                            <p>Sweet Onion, Chipotle Southwest <span class="label label-default">Wenig</span></p>
                        </li>
                        <li class="list-group-item">
                            <span class="lead">Extras</span>
                            <p>Salz, Pfeffer, Oregano</p>
                        </li>
                        <div><p><button type="button" class="btn btn-default pull-right clearfix">Bearbeiten</button></p></div>
                    </ul>
                </div>
            </div>
            
        </div>
<?php include 'footer.php'; ?>