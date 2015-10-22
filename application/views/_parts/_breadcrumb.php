<ol class="breadcrumb">
  <?php if ( isset($breadcrumb) ): ?>
    <?php foreach ($breadcrumb as $name => $value): ?>
      <?php if ( end($breadcrumb) == $value ): ?>
        <li class="active"><?php echo $name ?></li>
        <?php continue ?>
      <?php endif ?>
      <li><a href="<?php echo base_url($value) ?>"><?php echo $name ?></a></li>
    <?php endforeach ?>
  <?php endif ?>
</ol>