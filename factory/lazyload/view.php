<?php $this->load->view('_layouts/_header') ?>
<script src="<?php echo base_url('assets/js/jquery.lazyload.js') ?>"></script>
<script>
	$(function () {
		$("img.lazy").lazyload({
			effect: "fadeIn"
		});
	})
</script>
<main class="container">
	<img data-original="<?php echo base_url('assets/images/me.jpg') ?>" class="lazy img-responsive">
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<img data-original="<?php echo base_url('assets/images/girl.jpg') ?>" class="lazy img-responsive">
</main>
<?php $this->load->view('_layouts/_footer') ?>
