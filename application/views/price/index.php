<?php $this->load->view('_layouts/_header'); ?>
<main class="container">
  <canvas id="canvas"></canvas>
</main>
<!--
<?php foreach ($query as $key => $value): ?>
  <?php echo '\''.$value->date.'\',' ?>
<?php endforeach ?>

<?php foreach ($query as $key => $value): ?>
  <?php echo $value->price.',' ?>
<?php endforeach ?>
-->
<script>
  var data = {
    labels : [
      <?php foreach ($query as $key => $value): ?>
        <?php echo '\''.$value->date.'\',' ?>
      <?php endforeach ?>
    ],
    datasets : [
      // {
      //   fillColor : "rgba(220,220,220,0.5)",
      //   strokeColor : "rgba(220,220,220,1)",
      //   pointColor : "rgba(220,220,220,1)",
      //   pointStrokeColor : "#fff",
      //   data : [65,59,90,81,56,55,40]
      // },
      {
        fillColor : "rgba(151,187,205,0.5)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        data : [
          <?php foreach ($query as $key => $value): ?>
            <?php echo $value->price.',' ?>
          <?php endforeach ?>
        ]
      }
    ]
  };

  var ctx = document.getElementById("canvas").getContext("2d");
  window.myLine = new Chart(ctx).Line(data, {
    responsive: true,
    // animation: false,
    pointDot : false,
    pointHitDetectionRadius: 1,

  });
</script>
<?php $this->load->view('_layouts/_footer'); ?>