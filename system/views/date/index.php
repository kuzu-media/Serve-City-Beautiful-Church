<div class="row">
	<div class="table cols persist-area">
		<div class="row persist-header">
			<div class="cols col-3 title">
				<h2>Areas</h2>
			</div>
			<?php $last = count($dates) - 1; $empty_notes = true; foreach($dates as $index=>$date): if(!empty($date['notes'])) $empty_notes = false;?>
			<div class='cols col-3 title'>

				<h2><?php if($index === 0 && strtotime($date['date']) > strtotime('04/28/13')) echo "<a href='".Asset::create_url('date','index',array($page-1))."' class='arrow left'>Previous Month</a>" ?><?php echo $date['date'] ?><?php if(Session::get('logged_in') && Auth::user("member_type_id") !== "2"): ?><a class='edit_date tooltip' href="<?php echo Asset::create_url('date','update', array($date['id']))?>" data-date-id="<?php echo $date['id']?>" data-date-notes="<?php echo $date['notes'] ?>"><?php echo Asset::img('edit_date.png') ?><span>Edit Date Notes</span></a><?php endif;?><?php if($index ===  $last && strtotime($date['date']) < strtotime('05/25/14')) echo "<a href='".Asset::create_url('date','index',array($page+1))."' class='arrow right'>Next Month</a>" ?></h2>

			</div>
			<?php endforeach;?>
		</div>
		<?php if(!$empty_notes): ?>
		<div class="row">
			<div class="cols col-3"></div>

			<?php foreach($dates as $date):?>
			<div class="cols col-3 notes">

				<?php echo $date['notes'] ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif;?>
		<?php foreach($teams as $team)
		{
			echo "\n\n\n<div class='row'>\n";
				echo "\t<div class='cols col-3 team'>\n";
					$title = "\t\t<h3>";
					$title .= "<a ";
					$title .= 'href="'.Asset::create_url("team","get",array($team['id'])).'">';
					$title .= $team['name'].'</a></h3>';
					echo $title;
				echo "\n\t</div>";
				foreach($dates as $date){
					$past = strtotime($date['date']) > (time() - 24*60*60)?false:true;
					echo "\n\t<div class='cols col-3 team_date'>";
					$shift_count = 0;
					if($date['Shift']){
						foreach($date['Shift'] as $shift){
							$shift_members = $shift['ShiftMember'];
							$shift_members_info = $shift['Member'];
							$shift = $shift['Shift'];
							if($shift['team_id'] === $team['id']){
								echo "\n\t\t<div class='shift'>";
									echo "\n\t\t\t<p class='time'>\n\t\t\t\t<span>".$shift['time'].'</span>';
										if(Session::get('logged_in') && Auth::user("member_type_id") !== "2" && !$past){
											$edit  = "<a class='edit_opportunity tooltip'";
											$edit .= "href='".Asset::create_url('shift','post')."'";
											$edit .= "data-team-id='".$team['id']."'";
											$edit .= "data-date-id='".$date['id']."'";
											$edit .= "data-date-date='".$date['date']."'";
											$edit .= "data-team-name='".$team['name']."'";
											$edit .= "data-shift-id='".$shift['id']."'";
											$edit .= ">\n\t\t\t\t\t".Asset::img('edit.png')."\n\t\t\t\t\t<span>Edit Opportunity</span>\n\t\t\t\t</a>";
											echo "\n\t\t\t\t".$edit;
											$remove  = "<a class='remove tooltip' ";
											$remove .= "href='".Asset::create_url('shift','delete',array($shift['id']))."'";
											$remove .= ">x<span>Remove Opportunity</span></a>";
											echo "\n\t\t\t\t".$remove;
											$check  = "<a class='check_availability tooltip' ";
											$check .= "href='".Asset::create_url('TeamMember','available')."'";
											$check .= "data-shift_id='".$shift['id']."'";
											$check .= "data-team_id='".$team['id']."'";
											$check .= "data-date_id='".$date['id']."'";
											$check .= "data-date='".$date['date']."'";
											$check .= "data-time='".$shift['time']."'";
											$check .= "data-team_name='".$team['name']."'";
											$check .= ">&#10003;<span>Check Availability</span></a>";
											echo "\n\t\t\t\t".$check;
										}
									echo "\n\t\t\t</p>";
									if($shift['notes']) echo '<p class="notes">'.$shift['notes'].'</p>';
									$serving = false;

									if($shift_members)
									{
										foreach($shift_members_info as $index=>$member)
										{
											$current = false;
											if($logged_in && $member['id'] === Auth::user('id'))
											{
												$serving = true;
												$current= true;
											}
											if($shift_members[$index]['shift_member_type_id'] !== "3" && $shift_members[$index]['shift_member_type_id'] !== "4")
											{
												echo "\n\t\t\t<div class='name'>";
													echo "\n\t\t\t\t<p>";
														if($member['facebook_id']) echo "<a href='http://facebook.com/".$member['facebook_id']."'>";
														echo '<img src="'.$member['profile_pic'].'" />';
														echo $member['name'];
														if($member['facebook_id']) echo "</a>";
														if($current && !$past)
														{
															$cancel  = "<a class='cancel tooltip' ";
															$cancel .= "href=;".Asset::create_url('ShiftMember','delete',array($shift_members[$index]['id']))."'";
															$cancel .= ">x<span>Cancel Opportunity</span></a>";
															echo $canel;
														}
													echo "</p>";
												echo "\n\t\t\t</div>";
											}
										}

									}
									if(strtotime($date['date']) > strtotime("yesterday"))
									{
										$serve  = "\n\t\t\t<a href='#' ";
										$serve .= 'class="button ';
										$serve .= $serving?'inactive':'serve';
										$serve .= '" data-shift_id="'.$shift['id'] .'">Serve</a>';
										echo $serve;
									}
								echo "\n\t\t</div>";
								$shift_count++;
							}

						}
					}

					if(Session::get('logged_in') && Auth::user("member_type_id") !== "2" && !$past){
						$add  = "\n\t\t<a class='new_shift tooltip' ";
						$add .= 'href="'.Asset::create_url('shift','post').'" ';
						$add .= 'data-team-id="'.$team['id'].'" ';
						$add .= 'data-date-id="'.$date['id'].'" ';
						$add .= 'data-date-date="'.$date['date'].'" ';
						$add .= 'data-team-name="'.$team['name'].'"';
						$add .= '>+<span>Add Opportunity</span></a>';
						echo $add;
					}

					echo "\n\t</div>";
				}
			echo "\n\t</div>";
		}
	?>

	</div>
	<div id="fb-root"></div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<?php echo Asset::js("jquery.modal.min")?>


<script>

jQuery(document).ready(function($) {

	var logged_in = "<?php  var_export($logged_in) ?>";
	$(".inactive").on('click',function(e){
		e.preventDefault();
	});
	$(".serve").on('click',function(e){
		e.preventDefault();

		var button = $(this);

		// if we are logged in then save it as a shift_member
		if(logged_in === "true")
		{
			$.ajax({
				url: '<?php echo Asset::get_base()?>ShiftMember/post.json',
				type: 'post',
				data: {"shift_id": button.data("shift_id")},
				dataType: 'json',
				success: function (data) {
					var img = $("<img />").attr("src",data.member.profile_pic);
					var name = $("<p>").text(data.member.name);
					var link = "<?php echo Asset::create_url('ShiftMember','delete') ?>/"+data.shift_member_id;
					name.append("<a href='"+link+"' class='cancel tooltip'>x<span>Cancel Opportunity</span></a>");
					var div = $("<div>").addClass("name").append(img).append(name);

					button.addClass("inactive").before(div);
				}
			});
		}
		else
		{
			$('#login').modal();

			var href = "<?php echo $login_url ?>";
			var vars = {};
			var url = href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {vars[key] = decodeURIComponent(value); return "";});
			vars['redirect_uri'] += "/"+button.data("shift_id");
			$(".facebook a").attr("href",url+"?"+$.param(vars))
			$(".default a").each(function()
			{
				var link = $(this);
				var href = link.attr("href");
				link.attr("href",href+"/"+button.data("shift_id"));

			})

		}
	});
	var modal;
	var check_avail_data;
	var check_avail_url;
	$(".check_availability").on('click',function(e)
	{
			e.preventDefault();
			var button = $(this);
			check_avail_url = button.attr('href');
			check_avail_data = button.data();
			$.ajax({
					url: check_avail_url,
					type: 'post',
					data: check_avail_data,
					success: function (data) {
						modal = $(data);
						modal.appendTo("body").modal();
					}
				});
	});

	$("body").on('change','#group',function()
	{
		check_avail_data.group = $(this).val();
		$.ajax({
			url: check_avail_url,
			type: 'post',
			data: check_avail_data,
			success: function(data)
			{
				modal.html($(data).contents());
			}
		});

	});

	$("body").on('click','.request',function(e)
	{
		console.log('button clicked');
		var link = $(this);
		$.ajax({
				url: link.attr('href'),
				type: 'post',
				data: $.extend(modal.data(),link.data(),check_avail_data),
				success: function (data) {
					modal.html($(data).contents());
				}
			});
		e.preventDefault();
	});

	$('body').on('click','.close-modal',function(e)
	{
		$.modal.close();
	});

	<?php if($first):?>
		$("#first").modal();
	<?php endif;?>

	$(".edit_date").on('click',function(e)
	{
		e.preventDefault();

		var link = $(this);

		var modal = $("#date_notes");


		modal.find("#date_note_id").val(link.data('date-id'));
		modal.find("#notes").val(link.data('date-notes'));

		modal.modal();

	});

	$(".edit_opportunity").on('click',function(e)
	{
		e.preventDefault();

		var shift = $(this);
		var time = shift.parent().find(' > span').text();
		var notes = shift.parent().parent().find(' > .notes').text();
		var shift_info = shift.data();
		var modal = $("#new_shift");
		modal.find("h1").text("New Opportunity for "+shift_info.teamName+" on "+shift_info.dateDate)
		modal.find("#date_id").val(shift_info.dateId);
		modal.find("#team_id").val(shift_info.teamId);
		modal.find("#shift_id").val(shift_info.shiftId);
		modal.find("#time").val(time);
		modal.find("#notes").val(notes);

		modal.modal();
	});

	$(".new_shift").on('click',function(e)
	{
		e.preventDefault();

		var shift_info = $(this).data();
		var modal =$("#new_shift");
		modal.find("h1").text("New Opportunity for "+shift_info.teamName+" on "+shift_info.dateDate)
		modal.find("#date_id").val(shift_info.dateId);
		modal.find("#team_id").val(shift_info.teamId);

		modal.modal();

	});
});

function UpdateTableHeaders() {
   $(".persist-area").each(function() {

       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader", this)

       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           floatingHeader.css({
            "visibility": "visible"
           });
       } else {
           floatingHeader.css({
            "visibility": "hidden"
           });
       };
   });
}

// DOM Ready
$(function() {

   var clonedHeaderRow;

   var title_width = $(".persist-header:first").find(".title:first").width();
   $(".persist-area").each(function() {
       clonedHeaderRow = $(".persist-header", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .css("width", clonedHeaderRow.width())
         .addClass("floatingHeader")
         .find(".title")
         .width(title_width);


   });

   $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");

});
</script>


<?php if($first):?>
<div class="modal" id="first">
	<a href="#close" class="close-modal">Close</a>
	<div class="row">
		<h1 class="cols">Thanks for Joining Us!</h1>
		<p class="cols">To learn more about us and keep up to date be sure to join the Ops Team Facebook Group!<br />&nbsp;<a href="https://www.facebook.com/groups/345282898925907/"><?php echo Asset::img('ops.png') ?></a></p>
	</div>
</div>
<?php endif;?>

<?php if(Session::get('logged_in') && Auth::user("member_type_id") !== "2"): ?>
<div class="modal" id="new_shift">
	<a href="#close" class="close-modal">Close</a>
	<h1></h1>

	<form method='POST' action='<?php echo Asset::create_url('shift','post')?>'>
		<input type="hidden" name="shift_id" id="shift_id" />
		<input type="hidden" name="date_id" id="date_id" />
		<input type="hidden" name="team_id" id="team_id" />
		<div>
			<label for='time'>Time:</label>
			<input type='text' id='time' name='time' value='<?php if(isset($time)) echo $time; ?>' placeholder="ex. 5:45 pm" />
		</div>
		<div>
			<label for='notes'>Notes:</label>
			<input type='text' id='notes' name='notes' value='<?php if(isset($notes)) echo $notes; ?>' placeholder="ex. Toddlers" />
		</div>
		<input type='submit' value='save' class="button" />
	</form>

</div>
<div class="modal" id="date_notes">
	<a href="#close" class="close-modal">Close</a>
	<h1>Edit Date Notes</h1>

	<form  method='POST' action='<?php echo Asset::create_url('date','update',array(1))?>'>
		<input type="hidden" name="id" id="date_note_id" />
		<div>
			<label for='notes'>Notes:</label>
			<textarea id="notes" name="notes"><?php if(isset($notes)) echo $notes; ?></textarea>
		</div>
		<input type='submit' value='save' class="button" />
	</form>

</div>
<?php endif;?>
<div class="modal" id="login">
	<a href="#close" class="close-modal">Close</a>
	<div class="row">
		<h1>Thank You!</h1>
		<p class="cols col-12">Thank you for choosing to serve our community. Please sign in or join so we can know more about you and your preferences.</p>
	</div>
	<div class="row">
		<div class="col-6 cols">
			<h2>Sign In</h2>
			<div class="facebook"><a href=""><?php echo Asset::img('login.png') ?></a></div>
			<p class="center default"><a href="<?php echo Asset::create_url("member","login")?>" class="center">Login without Facebook</a></p>
		</div>
		<div class="col-6 cols">
			<h2>Join Us</h2>
			<div class="facebook"><a href=""><?php echo Asset::img('register.png') ?></a></div>
			<p class="center default"><a href="<?php echo Asset::create_url("member","post") ?>" class="center">Signup without Facebook</a></p>
		</div>
	</div>
</div>
</div>
