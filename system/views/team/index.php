<div class="row">
	<div class="bucket cols">
		<h1>Welcome to Operations</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, sequi, voluptates itaque reiciendis minus eaque porro dignissimos unde incidunt veniam quidem eos nulla quisquam inventore nesciunt cupiditate nemo? Dolorum, ex.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ad cumque enim eligendi dignissimos soluta dolorem. Fugit, eius accusamus repellat repudiandae illo numquam provident unde corporis necessitatibus vero totam aut.</p>
	</div>
</div>
<div class="row">
<h2 id="areas">Areas to Serve</h2>
</div>

<div class="row">
<?php foreach($teams as $team):?>
	<div class="cols col-4">
		<div class="bucket">
			<?php echo Asset::img($team['photo'])?>
			<h3><a href="<?php echo  Asset::create_url("team","get",array($team['id']))?>"><?php echo $team['name']?></a></h3>
			<p><?php echo $team['summary']?></p>
		</div>
	</div>
<?php endforeach; ?>
</div>
