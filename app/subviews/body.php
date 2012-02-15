<div class='container'>
	<div class='span-24 home'>
		<?php
			$message = '';
			$type = $this->get('type');
			if($type == 'sales') $message = 'Here is your sales pipeline';
			if($type == 'live') $message = 'Here are your live projects';
			if($type == 'waiting') $message = 'Here are projects for which there are no updates';
			if($type == 'closed') $message = 'Here are projects you have finished';
			if($type == 'declined') $message = 'Here are projects which were declined';
		?>
		<h1>
			<?php echo $message ?>
			&nbsp;
			<small>
				<a href='<?php echo '?sort=status' ?>'>sort by status</a>
				&nbsp; | &nbsp;
				<a href='<?php echo '?sort=date' ?>'>sort by date</a>
				&nbsp; | &nbsp;
				<a href='<?php echo '?sort=client' ?>'>sort by client</a>
				&nbsp; | &nbsp;
				<a href='<?php echo '?sort=project' ?>'>sort by project</a>
			</small>
		</h1>
		<br />
	</div>
	<div class='span-24'>
		<?php
			$list = $this->get('list');
			foreach ($list as $item) {
				$project_id = _g($item, 'projects_id');
				$project_name = _g($item, 'projects_name');
				$project_status = _g($item, 'projects_status');
				$project_created = _g($item, 'projects_created');

				$client_id = _g($item, 'clients_id');
				$client_name = _g($item, 'clients_name');
				$client_company = _g($item, 'clients_company');
				$client_email = _g($item, 'clients_email');
				$client_created = _g($item, 'clients_created');

				$status_id = _g($item, 'status_id');
				$status_status = _g($item, 'status_status');
				$status_date = _g($item, 'status_date');
				$status_comment = _g($item, 'status_comment');
				$status_created = _g($item, 'status_created');

				$type = $this->get('type');
				//display($type);

				$show_this_row = false;
				if($type == 'sales') {
					if( ($status_status < 81) && ($status_status != 60) ) {
						$show_this_row = true;
					}
				} else if($type == 'live') {
					if( ($status_status > 90) && ($status_status < 180) ) {
						$show_this_row = true;
					}
				} else if($type == 'waiting') {
					if( ($status_status == 60) ) {
						$show_this_row = true;
					}
				} else if($type == 'closed') {
					if($status_status == 180) {
						$show_this_row = true;
					}					
				} else if($type == 'declined') {
					if($status_status == 90) {
						$show_this_row = true;
					}
				}

				if($show_this_row) {

					$relative_time = '';

					if($status_date == 0) {
						$status_date = '&nbsp;';
					} else {
						$actual_time = date('D, d M Y h:i A', $status_date);
						$time_difference = getReadableTime(time() - $status_date);

						if($time_difference > 0)
							$relative_time =  $time_difference . ' ago';
						else 
							$relative_time = '<span style="color: green;">coming up in ' . getReadableTime($status_date - time()) . '</span>';

						$status_date = $actual_time . '<br />' . $relative_time;						
					}

					$status_list = getStatusList();
					if(isset($status_list[$status_status])) {
						$status_status = $status_list[$status_status];
					}

					if($status_status == '') $status_status = '&nbsp;';
					if($status_date == '') $status_date = '&nbsp;';
					if($status_comment == '') $status_comment = '&nbsp;';

					$image = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($client_email))) . '?s=24';

					echo "<div class='span-24 statusrow'>";
					echo "	<div class='span-1'><img style='width: 24px; height: 24px;' src='{$image}' /></div>";
					echo "	<div class='span-3'><a class='fakelink' target='_blank' href='https://mail.google.com/mail/u/0/?shva=1#label/" . urlencode($client_name) . "'>{$client_name}</a></div>";
					echo "	<div class='span-3 home-light'><a class='fakelink2' href='https://mail.google.com/mail/u/0/?shva=1#label/" . urlencode($project_name). "' target='_blank'>{$project_name}</a></div>";
					echo "	<div class='span-3'>{$status_status}</div>";
					echo "	<div class='span-5 home-light'>{$status_date}</div>";
					echo "	<div class='span-7 home-slant'>{$status_comment}</div>";
					echo "	<div class='span-2 last'><a href='" . href('/home/update/' . $client_id . '/' . $project_id) . "'>update</a></div>";
					echo "</div>";
				}
			}
		?>
	</div>
</div>