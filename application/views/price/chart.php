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
  <!-- <h2 class="text-center">淨值表</h2> -->
  <!-- <canvas id="canvas"></canvas> -->
  <div id="canvas" style="height: 400px; width: 100%;"></div>
  <!-- <h2 class="text-center">成功率表</h2> -->
  <!-- <canvas id="canvasSuccess"></canvas> -->
  <div id="canvasSuccess" style="height: 400px; width: 100%;"></div>
</main>
<script>
$(function () {
  $("select").change(function () {
    $("form").submit();
  })
})
window.onload = function () {
  var chart = new CanvasJS.Chart("canvasSuccess",
  {
    zoomEnabled: true,
    title:{
      text: "成功率表" 
    },
    animationEnabled: true,
    
    axisY :{
      includeZero:false
    },
    
    data: [{
      type: 'line',
      xValueType: "dateTime",
      dataPoints: [
        <?php foreach ($query as $key => $value): ?>
        {
          x: new Date(<?php echo str_replace('-', ', ', $value->fundDate) ?>),
          y: <?php echo $value->success_percent ?>   
        },
        <?php endforeach ?>
      ]
    }]
  });

  var chart2 = new CanvasJS.Chart("canvas",
  {
    zoomEnabled: true,
    title:{
      text: "淨值表" 
    },
    animationEnabled: true,
    
    axisY :{
      includeZero:false
    },

    data: [{
      type: 'line',
      xValueType: "dateTime",
      dataPoints: [
        <?php foreach ($query as $key => $value): ?>
        {
          x: new Date(<?php echo str_replace('-', ', ', $value->fundDate) ?>),
          y: <?php echo $value->price ?>,
        },
        <?php endforeach ?>
      ]
    }]
  });
  chart.render();
  chart2.render();
}
</script>
<?php $this->load->view('_layouts/_footer'); ?>
