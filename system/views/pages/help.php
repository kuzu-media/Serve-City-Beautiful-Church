<div class="row container" id="help">
	<div class="cols bucket">
		<h1 class="cols">Help</h1>
		<div class="cols col-3">
			<h3>Table of Contents</h3>
			<ul>
				<li><a href="#member_type">Member Types</a></li>
				<ul>
					<li><a href="#server">Server</a></li>
					<li><a href="#shepherd">Shepherd</a></li>
					<li><a href="#team_leader">Team Leader</a></li>
					<li><a href="#archived">Archived Members</a></li>
					<li><a href="#change">Change Member Type</a></li>
				</ul>
				<li><a href="#opportunities">Opportunities</a></li>
				<ul>
					<li><a href="#create_op">Create New Opportunity</a></li>
					<li><a href="#delete_op">Delete Opportunity</a></li>
				</ul>
				<li><a href="#check_availability">Checking Availability</a></li>
				<ul>
					<li><a href="#recommended">Recommended</a></li>
					<li><a href="#serving">Already Serving</a></li>
					<li><a href="#sunday">Don't Prefer This Sunday</a></li>
					<li><a href="#weeks">Already Served Preferred Amount of Weeks</a></li>
					<li><a href="#archived_members">Archived</a></li>
				</ul>
				<li><a href="#team_pages">Editing Team Pages</a></li>
				<li><a href="#testimonials">Add Testimonial</a></li>
				<li><a href="#alerts">Alerts</a></li>
				<ul>
					<li><a href="#weclome">Welcome</a></li>
					<li><a href="#reminder">Reminder</a></li>
					<li><a href="#new_member">New Member</a></li>
					<li><a href="#team_lead_reminder">Team Leader Reminder</a></li>
				</ul>
			</ul>
		</div>
		<div class="cols col-9">
			<h3 id="member_type">Member Types</h3>
			<p>There are three different types of members:</p>

			<h4 id="server">Server</h4>
			<p>A server is the most basic of members. This people can simply view the calendar and choose opportunities to serve on.</p>

			<h4 id="shepherd">Shepherd</h4>
			<p>A shepherd is a person who team leaders feel understand the process of their team. They are someone that can be counted on and are willing to help welcome new members into the team. A shephard see no visual different in the site, however they receive and additional update of when a <a href="#new_member">new member</a> joins the team. (You can view details of this alert <a href="#new_member">below</a>)</p>

			<h4 id="team_leader">Team Leader</h4>
			<p>A team leader is someone who is in charge of managing a team. They are responsible for keeping their team pages update to date and creating new opportunities. The team leader has a very different view of the site. They are able to see the listing of all the members on their respective teams. They can also see the calendar with extra capabilities, such as <a href="create_op">creating</a> and <a href="#delete_op">delete</a> opportunities. They also have complete control over <a href="#team_pages">team pages</a>, and <a href="#testimonails">testimonials</a> on those pages. Team leaders are also responsible for making sure their teams are full and if they are not to <a href="#check_availability">check availability</a> and reach out to available team members.</p>

			<h4 id="archived">Archived Members</h4>
			<p>These are members who team leaders feel haven't served in a while, or no longer attend the church.</p>

			<h4 id="change">Change Member Type</h4>
			<p><?php echo Asset::img('help_pics/change_type.png')?>Go to the <a href="<?php echo Asset::create_url('team','admin')?>">team page</a> and select a new member type from the drop-down(a) of any member. Then save the update by clicking on the save button(b).</p>

			<h3 id="opportunities">Opportunities</h3>
			<p>Opportunities are times for when members can serve. Each opportunity gets its own serve button that any member can click on.</p>

			<h4 id="create_op">Create New Opportunity</h4>
			<p><?php echo Asset::img('help_pics/new_opportunity.png') ?>To create a new opportunity go to the the calendar page. As a team leader you will be able to see "+" buttons on any team and date.</p>

			<h4 id="delete_op">Delete Opportunity</h4>
			<p><?php echo Asset::img('help_pics/delete_opportunity.png')?>To delete a opportunity simply click the "X" next to any opportunity. You can only delete opportunities that do not already have members.</p>

			<h3 id="check_availability">Checking Availability</h3>
			<p><?php echo Asset::img('help_pics/check_availability.png')?>To find members that are available to help serve on any night for any opportunity simply click the check mark next to each opportunity.</p>

			<h4 id="recommended">Recommended</h4>
			<p>Recommended members are members who prefer this Sunday, or have no preferred Sunday, have not reached their preferred amount of weeks, aren't already serving that week and are non-archived members.</p>

			<h4 id="serving">Already Serving</h4>
			<p>Already serving are members that are already serving that week, prefer this Sunday, or have no preferred Sunday, and are non archived members.</p>

			<h4 id="sunday">Don't Prefer This Sunday</h4>
			<p>Members who don't prefer to work this Sunday, have not reached their preferred amount of weeks, aren't already serving that week and are non-archived members.</p>

			<h4 id="weeks">Already Served Preferred Amount of Weeks</h4>
			<p>Already serving preferred amount of weeks, prefer this Sunday, or have no preferred Sunday, aren't already serving that week and are non-archived members.</p>

			<h4 id="archived_members">Archived</h4>
			<p>Members who have been <a href="#archived">archived</a> by team leaders.</p>

			<h3 id="team_pages">Editing Team Pages</h3>
			<p><?php echo Asset::img('help_pics/edit_team.png')?>Team leaders can update any of the team pages by clicking "Edit Team" on any team page. You can update the team name, the summary for the home page, the photo, a link for a video, and the main content of the team page.</p>

			<h3 id="testimonails">Add Testimonials</h3>
			<p><?php echo Asset::img('help_pics/add_testimonial.png')?>Team Leaders can add testimonials to any team page by clicking "Add Testimonials" on any team page. You can add a name , a photo of the person, and content of the testimonials.</p>

			<h3 id="alerts">Alerts</h3>
			<p>There are a number of alerts that go out to members at different times.</p>

			<h4 id="welcome">Welcome</h4>
			<p>When a new member joins the site they will get an email welcoming them and telling them a little about the team and how they can participate.</p>

			<h4 id="reminder">Reminder</h4>
			<p>Each week if a member has signed up to get a reminder they get a text or email reminding them about their serving opportunity that coming Sunday.</p>

			<h4 id="new_member">New Member</h4>
			<p>When a member chooses to serve on a team that they have never served on before <a href="#team_leader">team leaders</a> and <a href="#shepherd">shepherds</a> get a text or email notifying them that the member has joined.</p>

			<h4 id="team_lead_remind">Team Leader Reminder</h4>
			<p>Each week <a href="#team_leader">team leaders</a> will get an email showing who is serving the upcoming week. This helps to make sure that teams are fully capable of serving on the following Sunday, and if they aren't team leaders can reach out to members.</p>

		</div>
	</div>
</div>