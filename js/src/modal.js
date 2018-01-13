let vimeoPlayer;

function embedInit() {
	const videos = document.querySelectorAll('[data-videomodal]');
	videos.forEach(video => {
		video.addEventListener('click', openModal);
	});
}

function openModal(e) {
	e.preventDefault();
	const header = document.querySelector('.site-header');
	const modal = document.querySelector('.video__modal');
	const closeBtn = document.querySelector('.btn--close');
	const anchor = e.target.offsetParent;
	const vimeoID = anchor.getAttribute('data-vimeoid');
	header.classList.add('hide');
	modal.classList.add('active');
	closeBtn.classList.add('active');
	toggleOverlay();
	//if player is not created, createPlayer, else:
	initPlayer(vimeoID);
	closeBtn.addEventListener('click', closeModal);
}

function closeModal() {
	const header = document.querySelector('.site-header');
	const modal = document.querySelector('.video__modal');
	const closeBtn = document.querySelector('.btn--close');
	vimeoPlayer.pause();
	header.classList.remove('hide');
	modal.classList.remove('active');
	closeBtn.classList.remove('active');
	toggleOverlay();
	closeBtn.removeEventListener('click', closeModal);
}



function initPlayer(id) {
	const iframe = document.querySelector('.video__modal iframe');
	// console.log('id', id);

	if (iframe) {
		vimeoPlayer.loadVideo(id).then(function (id) {
			vimeoPlayer.play();
		}).catch(function (error) {
			return "error";
		});
	} else {
		const vimeoID = id || document.querySelector('[data-vimeoid]').dataset.vimeoid;
		vimeoPlayer = new Vimeo.Player('player', { id: vimeoID, responsive: true });
		vimeoPlayer.play();
	}

}