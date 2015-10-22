<?php $this->load->view('_layouts/_header'); ?>
<main class="container">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>標題</label>
			<input type="text" class="form-control" name="title" required>
		</div>

		<div class="form-group">
			<label>密碼</label>
			<input type="password" class="form-control" name="password">
		</div>

		<div class="form-group">
			<label>檔案</label>
			<input type="file" name="userfile" class="form-control">
		</div>

		<div class="form-group">
			<label>多選單</label>
			<br>
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

		<div class="form-group">
			<label>單選單</label>
			<br>
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

		<div class="form-group">
			<label>日期</label>
			<input type="date" name="date" class="form-control" value="<?php echo date("Y-m-d") ?>">
		</div>

		<div class="form-group">
			<label>內容</label>
			<textarea name="content" class="form-control" rows="20"></textarea>
		</div>

		<div class="form-group text-center">
			<input type="submit" class="btn btn-primary btn-lg" value="送出">
		</div>
	</form>
</main>
<?php $this->load->view('_components/_tinymce.php'); ?>
<?php $this->load->view('_layouts/_footer'); ?>