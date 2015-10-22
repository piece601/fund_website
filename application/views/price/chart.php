<?php $this->load->view('_layouts/_header'); ?>
<main class="container">
  <h1 class="text-center"><?php echo $fundName ?></h1>
  <hr>
  <form class="form-inline text-center">
    <div class="form-group">
      <label>從</label>
      <input type="date" class="form-control" name="startDate" value="<?php echo $startDate ?>">
    </div>
    <div class="form-group">
      <label> 到</label>
      <input type="date" class="form-control" name="endDate" value="<?php echo $endDate ?>">
    </div>
    <div class="form-group">
      <label> 基金名稱</label>
      <select name="fundeName" class="form-control">
        <?php foreach ($categories as $value): ?>
          <?php if ($value->fundName == $fundName): ?>
            <option value="<?php echo $value->fundeName ?>" selected><?php echo $value->fundName ?></option>
            <?php continue; ?>
          <?php endif ?>
          <option value="<?php echo $value->fundeName ?>"><?php echo $value->fundName ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">送出</button>
  </form>
  <hr>
  <h2 class="text-center">淨值表</h2>
  <canvas id="canvas"></canvas>
  <h2 class="text-center">成功率表</h2>
  <canvas id="canvasSuccess"></canvas>
</main>
<script>
  var data = {
    labels : [
      <?php foreach ($fundPrices as $key => $value): ?>
        <?php echo '\''.$value->date.'\',' ?>
      <?php endforeach ?>
    ],
    datasets : [
      {
        fillColor : "rgba(151,187,205,0.5)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        data : [
          <?php foreach ($fundPrices as $key => $value): ?>
            <?php echo $value->price.',' ?>
          <?php endforeach ?>
        ]
      }
    ]
  };

  var dataSuccess = {
    labels : [
      <?php foreach ($query as $key => $value): ?>
        <?php echo '\''.$value->fundDate.'\',' ?>
      <?php endforeach ?>
    ],
    datasets : [
      {
        fillColor : "rgba(151,187,205,0.5)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        data : [
          <?php foreach ($query as $key => $value): ?>
            <?php echo $value->success_percent.',' ?>
          <?php endforeach ?>
        ]
      }
    ]
  };

  var ctx = document.getElementById("canvas").getContext("2d");
  window.myLine = new Chart(ctx).Line(data, {
    responsive: true,
    animation: false,
    pointDot : false,
    pointHitDetectionRadius: 1,

  });
  var ctx2 = document.getElementById("canvasSuccess").getContext("2d");
  window.myLine = new Chart(ctx2).Line(dataSuccess, {
    responsive: true,
    animation: false,
    pointDot : false,
    pointHitDetectionRadius: 1,

  });

</script>
<?php $this->load->view('_layouts/_footer'); ?>