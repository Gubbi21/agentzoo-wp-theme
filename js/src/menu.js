function headerInit() {
	const header = document.querySelector('.site-header');
	const menuToggle = header.querySelector('.menuToggle');
	const overlay = document.querySelector('.overlay');
	menuToggle.addEventListener('click', toggleMenu);
	
	overlay.addEventListener('click', function() {
		const menuIsActive = document.querySelector('.navigation__container').classList.contains('active');
		const modalIsActive = document.querySelector('.video__modal').classList.contains('active');

		if(menuIsActive) {
			toggleMenu();
		} else if(modalIsActive) {
			closeModal()
		} else {
			return;
		}
	});

	addClassHeaderOnBackground();
}
function toggleMenu() {
	const header = document.querySelector('.site-header');
	const menuToggle = header.querySelector('.menuToggle');
	const menuContainer = document.querySelector('.navigation__container');
	const makeActive = menuContainer.classList.toggle('active');
	const menuToggleText = menuToggle.querySelector('span.toggleText');
	const icon = menuToggle.querySelector('i.fa');

	menuToggle.classList.toggle('black');

	toggleOverlay();
	
	//TODO: delay until tranistionend
	if(makeActive) {
		menuToggleText.innerHTML = 'Close';
		icon.classList.remove('fa-bars');
		icon.classList.add('fa-times');
	} else {
		menuToggleText.innerHTML = 'Menu';
		icon.classList.add('fa-bars');
		icon.classList.remove('fa-times');
	}
}

function addClassHeaderOnBackground() {
	const header = document.querySelector('.site-header');
	const headerHeight = header.offsetHeight;
	const scrollPosition = window.scrollY;
	const scrollOffset = scrollPosition + (headerHeight / 2);
	const sections = document.querySelectorAll('[data-bgColor]');

	sections.forEach(section => {
		const top = section.offsetTop;
		const height = section.offsetHeight;
		const bottom = top + height;

		if ( scrollOffset >= top && scrollOffset <= bottom ) {
			const bgColor = section.dataset.bgcolor;
			if (header.classList.contains(`${bgColor}--bg`)) {
				return;
			} else if (bgColor === 'light'){
				header.classList.remove('dark--bg');
				header.classList.add('light--bg');
			} else {
				header.classList.add('dark--bg');
				header.classList.remove('light--bg');
			}
		}
	});
}