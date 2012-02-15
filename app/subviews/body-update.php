<?php

	$error = $this->get('error');
	$method = $this->get('method');

	$client = $this->get('client');
	$project = $this->get('project');

	$client_id = _g($client, 'id');
	$client_name = _g($client, 'name');
	$client_company = _g($client, 'company');
	$client_email = _g($client, 'email');

	$image = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($client_email))) . '?s=30';

	$project_id = _g($project, 'id');
	$project_name = _g($project, 'name');

?>
<div class='container'>
	<div class='span-24' style='border-bottom: 1px solid #EEE; font-size: 24px; color: #999;'>
		<img style='width: 30px; height: 30px; border-radius: 15px; position: relative; top: 7px;' src='<?php echo $image ?>' />
		<b style='color: #444;'><?php echo $client_name ?></b>'s project titled 
		<b style='color: #444;'><?php echo $project_name ?></b>
		&nbsp; &nbsp;<small class='updatestatusbutton'><small><small><u>Update Status</u></small></small></small>
		<br />&nbsp;
	</div>
	<div class='span-24'>
		&nbsp;
	</div>
	<div class='span-24 updateform'>
		<div class='span-12 clients'>
			<div class='span-12 last'>
				<h1>Update Status for the project</h1>
				<br />
			</div>
			<?php
				if( ($error != '') && ($method == 'sales.status.update') ) {
					echo "<div class='span-12 last'><div class='error'>{$error}</div></div>";
				}
			?>
			<div class='span-12 last'>
				<div class='span-3'>
					<form method='post' action=''>
						<input type='hidden' name='method' value='sales.status.update' />
						<input type='hidden' name='client_id' value='<?php echo $client_id ?>' />
						<input type='hidden' name='project_id' value='<?php echo $project_id ?>' />
					<div class='label'>New Status</div>
				</div>
				<div class='span-9 last'>
					<div class=''>
						<select name='status' style='width: 180px;'>
							<?php
								$list = getStatusList();
								foreach ($list as $key => $value) {
									echo "<option value='{$key}'>{$value}</option>";
								}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
					<div class='label'>Time</div>
				</div>
				<div class='span-9 last'>
					<div class='label'>
						<input type='text' name='time' class='input' value='' />
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
					<div class='label'>Comment</div>
				</div>
				<div class='span-9 last'>
					<div class='label'>
						<input type='text' name='comment' class='input' value='' />
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
					<div class='label'>Link</div>
				</div>
				<div class='span-9 last'>
					<div class='label'>
						<input type='text' name='link' class='input' value='' />
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
				</div>
				<div class='span-9 last'>
					<input type='submit' name='Submit' class='submit' value='Update' />
					<br />&nbsp;
					</form>
				</div>
			</div>
		</div>
		<div class='span-12 last clients'>
			<div class='span-12 last'>
				<h1>Last Communication Update</h1>
				<br />
			</div>
			<?php
				if( ($error != '') && ($method == 'sales.status.commupdate') ) {
					echo "<div class='span-12 last'><div class='error'>{$error}</div></div>";
				}
			?>
			<div class='span-12 last'>
				<div class='span-3'>
					<form method='post' action=''>
						<input type='hidden' name='method' value='sales.status.commupdate' />
						<input type='hidden' name='client_id' value='<?php echo $client_id ?>' />
						<input type='hidden' name='project_id' value='<?php echo $project_id ?>' />
					<div class='label'>Time</div>
				</div>
				<div class='span-9 last'>
					<div class='label'>
						<input type='text' name='time' class='input' value='' />
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
					<div class='label'>Comment</div>
				</div>
				<div class='span-9 last'>
					<div class='label'>
						<input type='text' name='comment' class='input' value='' />
					</div>
				</div>
			</div>
			<div class='span-12 last'>
				<div class='span-3'>
				</div>
				<div class='span-9 last'>
					<input type='submit' name='Submit' class='submit' value='Update' />
					</form>
				</div>
			</div>

		</div>
	</div>
	<div class='span-24'>&nbsp;</div>
	<div class='span-24'>
		<?php
			$updates = $this->get('updates');
			foreach ($updates as $up) {
				$status_id = _g($up, 'id');
				$status_status = _g($up, 'status');
				$status_date = _g($up, 'date');
				$status_comment = _g($up, 'comment');
				$status_link = _g($up, 'link');
				$status_created = _g($up, 'created');

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
				echo "	<div class='span-3'>{$client_name}</div>";
				echo "	<div class='span-3 home-light'>{$project_name}</div>";
				echo "	<div class='span-3'>{$status_status}</div>";
				echo "	<div class='span-5 home-light'>{$status_date}</div>";
				echo "	<div class='span-9 last home-slant'>{$status_comment}</div>";
				echo "</div>";					
			}
		?>
	</div>
</div>