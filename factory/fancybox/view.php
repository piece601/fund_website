<?php $this->load->view('_layouts/_header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fancybox/source/jquery.fancybox.css?v=2.1.5') ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') ?>" />
<script src="<?php echo base_url('assets/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3') ?>"></script>
<script src="<?php echo base_url('assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.5') ?>"></script>
<script src="<?php echo base_url('assets/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') ?>"></script>
<script src="<?php echo base_url('assets/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') ?>"></script>
<script src="<?php echo base_url('assets/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6') ?>"></script>
<script>
  $(function() {
    $('.fancybox-thumbs').fancybox({
      prevEffect : 'none',
      nextEffect : 'none',
      closeBtn  : true,
      arrows    : false,
      nextClick : true,
      helpers : {
        thumbs : {
          width  : 50,
          height : 50
        }
      }
    });
  });
</script>
<main class="container">
  <a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?php echo base_url('assets/images/me.jpg') ?>"><img src="<?php echo base_url('assets/images/me.jpg') ?>" alt="" /></a>
  <a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?php echo base_url('assets/images/girl.jpg') ?>"><img src="<?php echo base_url('assets/images/girl.jpg') ?>" alt="" /></a>
</main>
<?php $this->load->view('_layouts/_footer'); ?>