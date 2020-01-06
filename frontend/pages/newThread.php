    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Themen Erstellen</div>
                    <div class="panel-body">
                        <form action="index.php?page=newThread" id="themen" name="themen" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="threadtitle" class="col-md-3 control-label">Themen Titel:</label>
                                <div class="col-md-9">
                                    <input type="text" id="threadtitle" name="threadtitle" class="form-control" placeholder="Themen Titel" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="threadmsg" class="col-md-3 control-label">Nachricht:</label>
                                <div class="col-md-9">
                                    <textarea id="threadmsg" name="threadmsg" class="form-control" placeholder="Nachricht"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="threadforen" class="col-md-3 control-label">Foren:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="threadforen" name="threadforen" required>
                                        <option value="0">Keine Foren</option>
                                        <?php
                                            $sql = $db->__query("SELECT FID, Title FROM foren");
                                            while($row = $db->__fetchArray($sql)) {
                                                echo '<option value="'.$row['FID'].'">'.$row['Title'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input type="submit" id="submit_thread" name="submit_thread" class="btn btn-primary" value="Thema erstellen" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
	$userID = 1;
        if(isset($_POST['submit_thread'])) $db->__query("INSERT INTO themen (Title, Message, UserID, FID) VALUES('".$_POST['threadtitle']."', '".$_POST['threadmsg']."', '".$userID."', '".$_POST['threadforen']."')");
    ?>