function checkParams() {
	var last_name = $('.last_name').val();
	var first_name = $('.first_name').val();
	var sex = $('.sex').val();
	var city = $('.city').val();

	if(last_name.length != 0 || first_name.length != 0 || sex.length != 0 || city.length != 0) {
		$('.send_button').removeAttr('disabled');
	} else {
		$('.send_button').attr('disabled', 'disabled');
	}
}