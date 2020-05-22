//<!-- Search function for tables -->
function search() {
	// Declare variables
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("searchInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("dataTable");
	tr = table.getElementsByTagName("tr");

	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}

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

$('.navbar-nav li').on('click', function () {
	$('.navbar-nav li').removeClass('active');
	$(this).addClass('active');
});


$(document).ready(function () {

	let lastScroll = 0;

	window.addEventListener("scroll", () => {
		const currentScroll = window.pageYOffset;
		if (currentScroll == 0) {
			$('#nav_bar_main').addClass('navbar-fixed-top');
			return;
		}

		if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
			// down
			$('#nav_bar_main').removeClass('navbar-fixed-top');
		} else if (currentScroll < lastScroll && body.classList.contains(scrollDown)) {
			// up
			$('#nav_bar_main').addClass('navbar-fixed-top');
		}
		lastScroll = currentScroll;
	});
});
