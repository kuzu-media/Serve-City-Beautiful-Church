<div class="row">
	<div class="bucket cols">
		<h1>Welcome!</h1>
		<p>Our desire as a church community is to empower one another to step into the various and unique ways God has made and gifted each one of us. This isn’t a top down thing where the leadership of our church leverages subordinate members to accomplish our agenda. Rather, we believe that God has given every one of us a piece of a very large puzzle. As each of us offers our unique contribution, we see a more complete picture of who He is and what He’s doing as He establishes the Kingdom of Heaven here on earth.</p>
	</div>
</div>
<div class="row">
<h2 id="areas">Areas to Serve</h2>
</div>

<?php foreach($teams as $i=>$team):?>
	<?php if($i%3 == 0) echo "<div class='row'>";?>
	<div class="cols col-4">
		<div class="bucket">
			<?php echo Asset::img($team['photo'])?>
			<h3><a href="<?php echo  Asset::create_url("team","get",array($team['id']))?>"><?php echo $team['name']?></a></h3>
			<p><?php echo $team['summary']?></p>
		</div>
	</div>
	<?php if($i%3 == 2) echo "</div>";?>
<?php endforeach; ?>
</div>
