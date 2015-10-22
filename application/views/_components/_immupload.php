<link rel="stylesheet" href="<?php echo base_url('assets/css/circles.css') ?>">
<div class="well text-center">
  <label for="">立即上傳</label>
  <div class="circles hidden">Loading...</div>
  <input id="immFile" class="form-control" type="file" name="userfile" />
  <p id="immText" class="hidden" style="margin: 30px 0 0">上傳中...</p>
</div>
<script src="<?php echo base_url('assets/js/ajaxfileupload.js')?>"></script>
<script>
$(function () {
  var ajaxFileUpload = function () {
    $("#immFile, #immText, .circles").toggleClass('hidden');
    $.ajaxFileUpload({
      url: "<?php echo base_url('test/form/immupload/')?>",
      secureuri: false,
      fileElementId: 'immFile', //這個是對應到 input file 的 ID
      dataType: 'text',
      success: function(data, status){
        if (data == '') {
          $("#immFile, #immText, .circles").toggleClass('hidden');
          alert('上傳失敗，檔案規格不符');
        } else {
          $("#immFile, #immText, .circles").toggleClass('hidden');
          var content = tinyMCE.activeEditor.getContent() + '<img class="img-responsive" src="<?php echo base_url()?>'+ data +'">';
          tinyMCE.activeEditor.setContent( content, {format : 'raw'});
        };
        $('#immFile').on('change', ajaxFileUpload);
      },
      error: function(data, status, e){
        alert('上傳失敗，伺服器忙碌中');
        $('#immFile').on('change', ajaxFileUpload);
      }
    });
  };
  $('#immFile').on('change', ajaxFileUpload);
});
</script>