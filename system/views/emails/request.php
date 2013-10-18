<h4>Hello <?= $name ?>,</h4>

<p>You have been invited into the following opportunities:</p>

<?php foreach($shifts as $shift):?>
	<p><strong><?= $shift['Request']['team_name']?></strong></p>
	<p><?= $shift['Request']['date'] ?> - <?= $shift['Request']['time']?></p>
	<p><a href="<?= Asset::create_url('ShiftMember','invite',array($shift['Request']['shift_member_id'],'accept'))?>" style="width:125px;background-color:#44c99f;display:inline-block;color:#fff;text-decoration:none;padding:10px 20px 8px;text-align:center;text-transform:uppercase;">Accept</a> <a href="<?= Asset::create_url('ShiftMember','invite',array($shift['Request']['shift_member_id'],'decline'))?>" style="padding-left: 10px; color: #44c99f;">decline</a></p>
<?php endforeach;?>

City Beautiful Church