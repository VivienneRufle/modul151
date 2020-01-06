    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">                
                    <div class="panel-heading">Kategorie Erstellen</div>
                    <div class="panel-body">
                        <form action="index.php?page=newCat" id="categories" name="categories" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="catname" class="col-md-3 control-label">Kategorie Name:</label>
                                <div class="col-md-9">
                                    <input type="text" id="catname" name="catname" class="form-control" placeholder="Kategorie Name" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catpos" class="col-md-3 control-label">Position:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="catpos" name="catpos" required>
                                        <option selected>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catshow" class="col-md-3 control-label">Anzeigen:</label>
                                <div class="col-md-9">
                                    <select id="catshow" name="catshow" class="form-control" required>
                                        <option value="0" selected>ALL</option>
                                        <option value="1">MOD</option>
                                        <option value="2">ADM</option>
                                        <option value="3">NONE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input type="submit" id="submit_cat" name="submit_cat" class="btn btn-primary" value="Kategorie erstellen" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit_cat'])) $db->__query("INSERT INTO `kategorie` (Title, Position, ShowHide) VALUES('".$_POST['catname']."', '".$_POST['catpos']."', '".$_POST['catshow']."')");
    ?>