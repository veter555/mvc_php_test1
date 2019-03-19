


<div class="row" >
	<div class="col-md-7 col-md-offset-2">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="/comment/add" method="post">
		<div class="form-group">
			<label for="inputName" class="col-sm-2 control-label">Имя</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="inputName" name="name" pattern="[a-zA-Z0-9]+" placeholder="Name" autofocus="" required="">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
			  <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" autofocus="" required="">
			</div>
		</div>
		<div class="form-group">
			<label for="inputText" class="col-sm-2 control-label">Текста задачи</label>
			<div class="col-sm-10">
			  <textarea type="text" class="form-control" id="inputText" name="text" pattern="[a-zA-Z0-9]+" rows="5" autofocus="" required=""></textarea>
			</div>
		</div>
                <div class="form-group">
			<label for="file" class="col-sm-2 control-label"></label>
			<div class="col-sm-10">
				<input  accept='image/*' id="picture" name="picture" type='file'>
				<p class="description">Подходящие форматы для фотографии: PNG, JPG, GIF.</p>
			</div>	
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<a class="btn btn-default" onclick="preview(); return false">Предварительный просмотр</a>
				<button type="submit" class="btn btn-default">Отправить</button>
			</div>
		</div>
	</form>

	</div>
</div>


