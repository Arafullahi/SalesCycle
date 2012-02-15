<div class='container'>
	<div class='span-24 clients'>
		<?php
			$client = $this->get('client');
			if(isset($client[0]['id']))
				$client = $client[0];

			$project_list = $this->get('project_list');

			$client_id = _g($client, 'id');
			$client_name = _g($client, 'name');
		?>
		<h1>
			<?php echo $client_name ?>'s Projects
			&nbsp;
			<small>
				<a href='<?php echo href('/clients') ?>'>back to all clients</a>
				&nbsp; | &nbsp;
				<a href='<?php echo href('/clients/edit/' . $client_id) ?>'>edit client</a>
			</small>
		</h1>
		<ul>
			<li><a style='color: #CCC;' href='<?php echo href('/projects/edit/' . $client_id . '/0') ?>'>Add a new project</a></li>
			<?php
				foreach ($project_list as $project) {
					$project_id = _g($project, 'id');
					$project_name = _g($project, 'name');
					echo "<li><a href='" . href('/projects/edit/' . $client_id . '/' . $project_id) . "'>{$project_name}</a></li>";
				}
			?>
		</ul>
	</div>
</div>