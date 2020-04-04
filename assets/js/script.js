function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#image').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
}

$("#imgInp").change(function () {
	readURL(this);
});


$(document).ready(function () {
	$("ul li").click(function (event) {

		$("ul li ").removeClass("active"); //Remove any "active" class 
		$("li", this).addClass("active"); //Add "active" class to selected tab // 
		// $(activeTab).show(); //Fade in the active content 
	});
});
