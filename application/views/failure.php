<?php $this->load->view('_layouts/_header'); ?>
<div class="alert alert-warning text-center"><h3><?php echo $message;?></h3></div> 
<p class="text-info text-center">三秒回前頁</p>
<script>setTimeout("history.go(-1)", 3000)</script>
<?php $this->load->view('_layouts/_footer'); ?>