<?php
$sql = $db->__query("SELECT * FROM posts WHERE TID = ".$_REQUEST['tid']." ORDER BY CreateDate ASC");
$count = 1;
while($row = $db->__fetchArray($sql)) {
    $username = $cats->getUser($row['UID']);
    $isTitle = !empty($row['postTitle']) ? $isTitle = $row['postTitle'] : $isTitle = '';
    $messages = $cats->encoding($row['postMessage']);
    $count += 1;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-11"><?php echo $isTitle; ?></div>
                        <div class="col-md-1"><a href="#" class="btn btn-xs btn-info pull-right">#<?php echo $count; ?></a></div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-- User-Area //-->
                        <div class="col-md-2 getSpan">
                            <span class="center">
                                <a href="#UserID=USERID" class="label label-username"><?php echo $username; ?></a>
                                <label class="label rank-benutzer">RANK</label>
                                <img src="http://placehold.it/100x100" class="avatar" />
                                <label class="label label-danger" title="<?php echo $username; ?> ist STATUS">STATUS</label>
                                <label class="label label-infos"><i class="fa fa-female"></i> : GESCHLECHT</label>
                                <label class="label label-infos" title="Registriert seit: <?php $cats->getRegDate($row['UID']); ?>"><i class="fa fa-calendar"></i> : <?php $cats->getRegDate($row['UID']); ?></label>
                                <label class="label label-infos" title="Themen: ZAHL"><i class="fa fa-comment"></i> : ANZAHL</label>
                                <label class="label label-infos" title="Beitr&auml;ge: ZAHL"><i class="fa fa-comments"></i> : ZAHL</label>
                            </span>
                        </div>

                        <!-- Post Message //-->
                        <div class="col-md-10">
                            <div class="cMiddle message">
                                <?php echo $messages; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Buttons //-->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6 postDate">
                            <label class="label label-infos" title="Erstellt am <?php $cats->getDate($row['CreateDate']); ?> um <?php $cats->getTime($row['CreateDate']); ?> Uhr"><i class="fa fa-calendar"></i> <?php $cats->getDate($row['CreateDate']); ?> &middot; <i class="fa fa-clock-o"></i> <?php $cats->getTime($row['CreateDate']); ?></label>
                        </div>
                        <div class="col-md-6">
                            <div class="postBtn">
                                <a href="#" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> antworten</a>
                                <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-quote-right"></i> zitieren</a>
                                <a href="#" class="btn btn-xs btn-warning"><i class="fa fa-flag"></i> melden</a>
                                <a href="#top" class="btn btn-xs btn-warning"><i class="fa fa-arrow-up"></i> TOP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>