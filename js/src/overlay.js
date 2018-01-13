function toggleOverlay() {
	const overlay = document.querySelector('.overlay');
	const blurables = document.querySelectorAll('.blurable');
	overlay.classList.toggle('active');
	blurables.forEach(blurable => blurable.classList.toggle('blur'));

}