<div class='container'>
	<div class='span-24 clients'>
		<h1>
			Add / Edit Project
			&nbsp;
			<small>
				<a href='<?php echo href('/projects/client/' . $this->get('client_id')) ?>'>back to all projects</a>
				&nbsp; | &nbsp;
				<a href='<?php echo href('/clients/edit/' . $this->get('client_id')) ?>'>edit client</a>
			</small>
		</h1>
		<br />
		<form method='post' action=''>
			<?php
				$client = $this->get('client');

				$client_id = _g($client, 'id');
				$client_name = _g($client, 'name');

				$project = $this->get('project');

				$project_id = _g($project, 'id');
				$project_name = _g($project, 'name');
			?>
			<input type='hidden' name='method' value='sales.projects.edit' />
			<input type='hidden' name='client_id' value='<?php echo $client_id ?>' />
			<div class='label'>Client</div>
			<div class='label'><b><?php echo $client_name ?></b></div>
			<div class='label'>Project Name</div>
			<input type='hidden' name='project_id' value='<?php echo $project_id ?>' />
			<input type='text' name='project_name' class='input' value='<?php echo $project_name ?>' />
			<br />
			<input type='submit' name='Submit' class='submit' value='Submit' />
		</form>
	</div>
</div>