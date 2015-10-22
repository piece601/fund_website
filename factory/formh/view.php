<?php $this->load->view('_layouts/_header'); ?>
<main class="container">
	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-sm-2 control-label">標題</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="title" required>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">密碼</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" name="password">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">檔案</label>
			<div class="col-sm-10">
				<input type="file" name="userfile" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">多選單</label>
			<div class="col-sm-10">
				<label class="checkbox-inline">
				  <input type="checkbox" name="test"> 1
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" name="test2"> 2
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" name="test3"> 3
				</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">單選單</label>
			<div class="col-sm-10">
				<label class="radio-inline">
				  <input type="radio" name="radio" value="option1"> 1
				</label>
				<label class="radio-inline">
				  <input type="radio" name="radio" value="option2"> 2
				</label>
				<label class="radio-inline">
				  <input type="radio" name="radio" value="option3"> 3
				</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">日期</label>
			<div class="col-sm-10">
				<input type="date" name="date" class="form-control" value="<?php echo date("Y-m-d") ?>">
			</div>	
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">內容</label>
			<div class="col-sm-10">
				<textarea name="content" class="form-control" rows="20"></textarea>
			</div>
		</div>

		<div class="form-group text-center">
			<div class="col-sm-offset-2 text-center">
				<input type="submit" class="btn btn-primary btn-lg" value="送出">
			</div>
		</div>
	</form>

</main>
<?php $this->load->view('_components/_tinymce.php'); ?>
<?php $this->load->view('_layouts/_footer'); ?>