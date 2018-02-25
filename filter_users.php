<div class="filter_users_block col-md-3">
	<form method="post" action="">
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label"><h5>Имя</h5></label>
			<div class="col-8">
				<input class="form-control first_name" type="text" name="first_name" placeholder="Введите имя" id="example-text-input" onkeyup='checkParams()'>
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-m2 col-form-label"><h5>Фамилия</h5></label>
			<div class="col-8">
				<input class="form-control last_name" type="text" name="last_name" value="" placeholder="Введите фамилию" id="example-text-input" onkeyup='checkParams()'>
			</div>
		</div>
		<h5>Пол</h5>
		<select name="sex" class="custom-select sex" onchange='checkParams()'>
			<option selected>Выберите пол</option>
			<option value="1">Женский</option>
			<option value="2">Мужской</option>
		</select>
		<div class="form-group row">
			<label for="example-search-input" class="col-2 col-form-label"><h5>Город</h5></label>
			<div class="col-8">
				<input class="form-control city" type="search" name="city" value="" placeholder="Город" id="example-search-input" onkeyup='checkParams()'>
			</div>
		</div>
		<input class="btn btn-primary send_button"  type="submit" name="submit" role="button" value="OK" disabled>
	</form>
</div>