<span style="float:left;"><a href="/gartnercus/index.php?r=gartner/admin">Reporting</a></span>
<div class="span11">
	
	<div class="span7" style="margin-left:200px;">
	<table class="table table-bordered table-hover table-striped">
		<caption style="margin:26px 0px;">
			<h2>Department Report</h2>
		</caption>
		<thead>
			<tr>
				<th>Department Requirements</th><th>Number</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(!empty($diets)) {
					foreach($diets as $diet) {	
			?>
			<tr class="warning">
				<td><?php 
						if(!empty($requirements[$diet['Department']]) and isset($requirements[$diet['Department']])){
						echo $requirements[$diet['Department']];
						}
					?></td>
				<td><?php echo $diet['countDepartment']; ?></td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
	</div>
</div>
<div style="height:460px;"></div>
<div>