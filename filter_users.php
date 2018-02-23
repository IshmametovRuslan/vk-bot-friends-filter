<div class="filter_users_block">
	<form method="post" action="">
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label"><h5>Имя</h5></label>
			<div class="col-5">
				<input class="form-control" type="text" name="first_name" placeholder="Введите имя" id="example-text-input">
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-m2 col-form-label"><h5>Фамилия</h5></label>
			<div class="col-5">
				<input class="form-control" type="text" name="last_name" placeholder="Введите фамилию" id="example-text-input">
			</div>
		</div>
		<h5>Пол</h5>
		<select name="sex" class="custom-select">
			<option selected>Выберите пол</option>
			<option value="1">Женский</option>
			<option value="2">Мужской</option>
		</select>

		<div class="form-group row">
			<label for="example-number-input" class="col-2 col-form-label"><h5>Возраст</h5></label>
			<div class="col-2">
				<input class="form-control" type="number" name="age1" placeholder="от 1" id="example-number-input">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<input class="form-control" type="number"name="age2" placeholder="до 99" id="example-number-input">
			</div>
		</div>
		<div class="form-group row">
			<label for="example-search-input" class="col-2 col-form-label"><h5>Город</h5></label>
			<div class="col-5">
				<input class="form-control" type="search" name="city" placeholder="Город" id="example-search-input">
			</div>
		</div>
		<input class="btn btn-primary" type="submit" name="submit" role="button" value="OK">
	</form>
</div>