<?php include 'header.php'; ?>

            <div class="page-header">
                <h1>SubConf</h1>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-sm-4">
                          <div class="list-group member-list">
		  				
			                <div class="input-group">
				                <span class="input-group-addon"><input type="checkbox"></span>
				                <a href="#mn" data-toggle="tab" class="list-group-item">
					                <h4 class="list-group-item-heading">Michael</h4>
					                <p class="list-group-item-text">
						                <small>Chicken Faijta - 30cm</small>
					                </p>
				                </a>
			                </div>
		
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-5 col-sm-5 tab-content border-left">
                            
                            <div class="tab-pane" id="mn">
                                <h3>Michael <span class="badge">5€</span></h3>
                                <form id="editform">
                                    <input type="hidden" name="name" value="Michael">
                                    <input type="hidden" name="email" value="example@example.com">
                                    
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Brot</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="bread" value="Honey Oat"> Honey Oat
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="bread" value="Italian"> Italian
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="bread" value="Vollkorn"> Vollkorn
                                                </label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Größe</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="size" value="15cm"> 15cm
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="size" value="30cm"> 30cm
                                                </label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Fleisch</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="meat" value="Chicken Faijta"> Chicken Faijta
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="meat" value="Tuna"> Tuna
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input required type="radio" name="meat" value="Kein Fleisch"> Kein Fleisch
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="doublemeat" value="Doppelt Fleisch"> Doppelt Fleisch
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Käse</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="cheese[]" value="Scheibenkäse"> Scheibenkäse
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="cheese[]" value="Frischkäse"> Frischkäse
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="cheese[]" value="Cheddar"> Cheddar
                                                </label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Gemüse</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Salat"> Salat
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Gurke"> Gurke
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Tomate"> Tomate
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Pepperoni"> Pepperoni
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Oliven"> Oliven
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="salad[]" value="Tomate"> Tomate
                                                </label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Sauce</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="sauce[]" value="Sweet Onion"> Sweet Onion
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="sauce[]" value="Chipotle Southwest"> Chipotle Southwest
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="sauce[]" value="BBQ"> BBQ
                                                </label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <span class="lead clearfix">Extras</span>

                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="extras[]" value="Salz"> Salz
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="extras[]" value="Pfeffer"> Pfeffer
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="checkbox" name="extras[]" value="Oregano"> Oregano
                                                </label>
                                            </div>

                                        </li>
                                    </ul>
                                <div><p><button type="submit" class="btn btn-default pull-right clearfix save-btn" data-loading-text="Wird gespeichert ...">Speichern</button></p></div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php'; ?>