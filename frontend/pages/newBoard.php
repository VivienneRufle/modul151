    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Foren Erstellen</div>
                    <div class="panel-body">
                        <form action="index.php?page=newBoard" id="foren" name="foren" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="forenname" class="col-md-3 control-label">Foren Name:</label>
                                <div class="col-md-9">
                                    <input type="text" id="forenname" name="forenname" class="form-control" placeholder="Foren Name" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="forendesc" class="col-md-3 control-label">Foren Beschreibung:</label>
                                <div class="col-md-9">
                                    <input type="text" id="forendesc" name="forendesc" class="form-control" placeholder="Foren Beschreibung" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="forenpos" class="col-md-3 control-label">Position:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="forenpos" name="forenpos" required>
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
                                <label for="forenshow" class="col-md-3 control-label">Anzeigen:</label>
                                <div class="col-md-9">
                                    <select id="forenshow" name="forenshow" class="form-control" required>
                                        <option value="0" selected>ALL</option>
                                        <option value="1">MOD</option>
                                        <option value="2">ADM</option>
                                        <option value="3">NONE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="forencat" class="col-md-3 control-label">Kategorie:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="forencat" name="forencat" required>
                                        <option value="0">Keine Kategorie</option>
                                        <?php
                                            $sql = $db->__query("SELECT `CatID`, `Title` FROM `kategorie`");
                                            while($row = $db->__fetchArray($sql)) {
                                                echo '<option value="'.$row['CatID'].'">'.$row['Title'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input type="submit" id="submit_foren" name="submit_foren" class="btn btn-primary" value="Foren erstellen" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit_foren'])) $db->__query("INSERT INTO `foren` (Title, Description, Position, ShowHide, CatID) VALUES('".$_POST['forenname']."', '".$_POST['forendesc']."', '".$_POST['forenpos']."', '".$_POST['forenshow']."', '".$_POST['forencat']."')");
    ?>