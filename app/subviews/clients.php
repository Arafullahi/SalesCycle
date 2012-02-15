<div class='container'>
	<div class='span-24 clients'>
		<h1>
			List of existing clients
			&nbsp;
			<small>
				<a href='<?php echo href('/clients') ?>'>sort alphabetically</a>
				&nbsp; | &nbsp;
				<a href='<?php echo href('/clients?sort=date') ?>'>sort by creation date</a>
			</small>
		</h1>
		<ul>
			<?php
				$list = $this->get('list');
				echo "<li><a style='color: #CCC;' href='" . href('/clients/edit/0') . "'>Add a new client</a></li>";
				foreach ($list as $client) {
					$client_id = _g($client, 'clients_id');
					$client_name = _g($client, 'clients_name');
					$client_company = _g($client, 'clients_company');
					$client_email = _g($client, 'clients_email');
					$projects_id_count = _g($client, 'projects_id_count');
					$projects_id = _g($client, 'projects_id');

					$number_of_projects = '';
					if($projects_id_count == 1) {
						if($projects_id > 0) {
							$number_of_projects = '1 project';
						} else {
							$number_of_projects = '<span style="color: red;">0 projects</span>';
						}
					} else {
						$number_of_projects = $projects_id_count . ' projects';
					}

					$image = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($client_email))) . '?s=24';

					echo "<li>
							<div style='display: inline-block; margin-bottom: 5px;'>
								<img src='" . $image . "' style='width: 24px; height: 24px; border-radius: 12px;' />
							</div>
							<div style='display: inline-block;'>
								<a href='" . href('/clients/edit/' . $client_id) . "'>{$client_name}</a>
								&nbsp;
								<small>
									<a href='" . href('/projects/client/' . $client_id) . "'>{$number_of_projects}</a>
									<br />
									{$client_company}
									&nbsp;
									{$client_email}
								</small>
							</div>
						</li>";
				}
			?>
		</ul>
	</div>
</div>