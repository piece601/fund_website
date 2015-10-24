<?php $this->load->view('_layouts/_header'); ?>
<main class="container">
	<table class="table table-hover">
		<tr class="info">
			<td>排名</td>
			<td>基金名稱</td>
			<td>淨值日</td>
			<td>淨值</td>
			<td>成功率</td>
		</tr>
		<?php foreach ($query as $key => $value): ?>
			<tr>
			
				<td><?php echo $key+1 ?></td>
				<td><a href="<?php echo base_url('price/success/'.$value->fundeName.'/'. date('Y-m-d', strtotime(date('Y/m/d'). '-1 years')) .'/'.date('Y-m-d').'/'.$value->years) ?>"><?php echo $value->fundName ?></a></td>
				<td><?php echo $value->fundDate ?></td>
				<td><?php echo $value->price ?></td>
				<?php if ($value->success_percent > 99): ?>
					<td class="text-success" style="font-size:24px"><?php echo $value->success_percent ?> 快買!</td>	
				<?php elseif ( $value->success_percent > 95 && $value->success_percent <= 99 ): ?>
					<td class="text-success" style="font-size:20px"><?php echo $value->success_percent ?></td>	
				<?php elseif ( $value->success_percent <= 95 && $value->success_percent > 80 ) : ?>
					<td class="text-info" style="font-size:16px;"><?php echo $value->success_percent ?></td>	
				<?php else: ?>
					<td class="text-warning"><?php echo $value->success_percent ?></td>	
				<?php endif ?>	
			</tr>
		<?php endforeach ?>	
	</table>
</main>
<?php $this->load->view('_layouts/_footer'); ?>