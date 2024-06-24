const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');

tombolCari.style.display = 'none';

keyword.addEventListener('keyup', function() {
	// const xhr = new XMLHttpRequest();

	// xhr.onreadystatechange = function() {
	// 	if (xhr.readyState == 4 && xhr.status == 200) {
	// 		container.innerHTML = xhr.responseText;
	// 	}
	// };

	// xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
	// xhr.send();

	fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
		.then((response) => response.text())
		.then((response) => (container.innerHTML = response));
});

function previewImage() {
	const gambar = document.querySelector('.gambar');
	const imgPreview = document.querySelector('.img-preview');

	const ofReader = new FileReader();
	ofReader.readAsDataURL(gambar.files[0]);

	ofReader.onload = function (oFREvent) {
		imgPreview.src = oFREvent.target.result;
	};
}