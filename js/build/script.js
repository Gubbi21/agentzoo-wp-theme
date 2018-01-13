'use strict';

window.addEventListener('load', init);

function init() {
	headerInit();
	embedInit();
	window.addEventListener('scroll', scrollEvents);
}

function scrollEvents() {
	addClassHeaderOnBackground();
}
'use strict';

function headerInit() {
	var header = document.querySelector('.site-header');
	var menuToggle = header.querySelector('.menuToggle');
	var overlay = document.querySelector('.overlay');
	menuToggle.addEventListener('click', toggleMenu);

	overlay.addEventListener('click', function () {
		var menuIsActive = document.querySelector('.navigation__container').classList.contains('active');
		var modalIsActive = document.querySelector('.video__modal').classList.contains('active');

		if (menuIsActive) {
			toggleMenu();
		} else if (modalIsActive) {
			closeModal();
		} else {
			return;
		}
	});

	addClassHeaderOnBackground();
}
function toggleMenu() {
	var header = document.querySelector('.site-header');
	var menuToggle = header.querySelector('.menuToggle');
	var menuContainer = document.querySelector('.navigation__container');
	var makeActive = menuContainer.classList.toggle('active');
	var menuToggleText = menuToggle.querySelector('span.toggleText');
	var icon = menuToggle.querySelector('i.fa');

	menuToggle.classList.toggle('black');

	toggleOverlay();

	//TODO: delay until tranistionend
	if (makeActive) {
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
	var header = document.querySelector('.site-header');
	var headerHeight = header.offsetHeight;
	var scrollPosition = window.scrollY;
	var scrollOffset = scrollPosition + headerHeight / 2;
	var sections = document.querySelectorAll('[data-bgColor]');

	sections.forEach(function (section) {
		var top = section.offsetTop;
		var height = section.offsetHeight;
		var bottom = top + height;

		if (scrollOffset >= top && scrollOffset <= bottom) {
			var bgColor = section.dataset.bgcolor;
			if (header.classList.contains(bgColor + '--bg')) {
				return;
			} else if (bgColor === 'light') {
				header.classList.remove('dark--bg');
				header.classList.add('light--bg');
			} else {
				header.classList.add('dark--bg');
				header.classList.remove('light--bg');
			}
		}
	});
}
'use strict';

var vimeoPlayer = void 0;

function embedInit() {
	var videos = document.querySelectorAll('[data-videomodal]');
	videos.forEach(function (video) {
		video.addEventListener('click', openModal);
	});
}

function openModal(e) {
	e.preventDefault();
	var header = document.querySelector('.site-header');
	var modal = document.querySelector('.video__modal');
	var closeBtn = document.querySelector('.btn--close');
	var anchor = e.target.offsetParent;
	var vimeoID = anchor.getAttribute('data-vimeoid');
	header.classList.add('hide');
	modal.classList.add('active');
	closeBtn.classList.add('active');
	toggleOverlay();
	//if player is not created, createPlayer, else:
	initPlayer(vimeoID);
	closeBtn.addEventListener('click', closeModal);
}

function closeModal() {
	var header = document.querySelector('.site-header');
	var modal = document.querySelector('.video__modal');
	var closeBtn = document.querySelector('.btn--close');
	vimeoPlayer.pause();
	header.classList.remove('hide');
	modal.classList.remove('active');
	closeBtn.classList.remove('active');
	toggleOverlay();
	closeBtn.removeEventListener('click', closeModal);
}

function initPlayer(id) {
	var iframe = document.querySelector('.video__modal iframe');
	// console.log('id', id);

	if (iframe) {
		vimeoPlayer.loadVideo(id).then(function (id) {
			vimeoPlayer.play();
		}).catch(function (error) {
			return "error";
		});
	} else {
		var vimeoID = id || document.querySelector('[data-vimeoid]').dataset.vimeoid;
		vimeoPlayer = new Vimeo.Player('player', { id: vimeoID, responsive: true });
		vimeoPlayer.play();
	}
}
'use strict';

function toggleOverlay() {
	var overlay = document.querySelector('.overlay');
	var blurables = document.querySelectorAll('.blurable');
	overlay.classList.toggle('active');
	blurables.forEach(function (blurable) {
		return blurable.classList.toggle('blur');
	});
}
'use strict';

var scrollToButtons = document.querySelectorAll('.scrollToBtn');

scrollToButtons.forEach(function (scrollToButton) {
  return scrollToButton.addEventListener('click', scrollToF);
});
function scrollToF(e) {
  e.preventDefault();
  var destination = e.target.getAttribute('href');
  var destinationNode = document.querySelector(destination);
  var destinationPosition = destinationNode.offsetTop;

  animateScrollTo(destinationPosition);
}

// repository: https://github.com/Stanko/animated-scroll-to
function animateScrollTo(desiredOffset) {
  var userOptions = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var defaultOptions = {
    speed: 500,
    minDuration: 250,
    maxDuration: 3000,
    cancelOnUserAction: true
  };

  var options = {};

  Object.keys(defaultOptions).forEach(function (key) {
    options[key] = userOptions[key] ? userOptions[key] : defaultOptions[key];
  });

  // get cross browser scroll position
  var initialScrollPosition = window.scrollY || document.documentElement.scrollTop;
  // cross browser document height minus window height
  var maxScroll = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight, document.body.offsetHeight, document.documentElement.offsetHeight, document.body.clientHeight, document.documentElement.clientHeight) - window.innerHeight;

  // If the scroll position is greater than maximum available scroll
  if (desiredOffset > maxScroll) {
    desiredOffset = maxScroll;
  }

  // Calculate diff to scroll
  var diff = desiredOffset - initialScrollPosition;

  // Do nothing if the page is already there
  if (diff === 0) {
    return;
  }

  // Calculate duration of the scroll
  var duration = Math.abs(Math.round(diff / 1000 * options.speed));

  // Set minimum and maximum duration
  if (duration < options.minDuration) {
    duration = options.minDuration;
  } else if (duration > options.maxDuration) {
    duration = options.maxDuration;
  }

  var startingTime = Date.now();

  // Request animation frame ID
  var requestID = null;

  // Method handler
  var handleUserEvent = null;

  if (options.cancelOnUserAction) {
    // Set handler to cancel scroll on user action
    handleUserEvent = function handleUserEvent(e) {
      cancelAnimationFrame(requestID);
    };
    window.addEventListener('keydown', handleUserEvent);
  } else {
    // Set handler to prevent user actions while scroll is active
    handleUserEvent = function handleUserEvent(e) {
      e.preventDefault();
    };
    window.addEventListener('scroll', handleUserEvent);
  }

  window.addEventListener('wheel', handleUserEvent);
  window.addEventListener('touchstart', handleUserEvent);

  var step = function step() {
    var timeDiff = Date.now() - startingTime;
    var t = timeDiff / duration - 1;
    var easing = t * t * t + 1;
    var scrollPosition = Math.round(initialScrollPosition + diff * easing);

    if (timeDiff < duration && scrollPosition !== desiredOffset) {
      // If scroll didn't reach desired offset or time is not elapsed
      // Scroll to a new position
      // And request a new step

      window.scrollTo(0, scrollPosition);
      requestID = requestAnimationFrame(step);
    } else {
      // If the time elapsed or we reached the desired offset
      // Set scroll to the desired offset (when rounding made it to be off a pixel or two)
      // Clear animation frame to be sure
      window.scrollTo(0, desiredOffset);
      cancelAnimationFrame(requestID);

      // Remove listeners
      window.removeEventListener('wheel', handleUserEvent);
      window.removeEventListener('touchstart', handleUserEvent);

      if (options.cancelOnUserAction) {
        window.removeEventListener('keydown', handleUserEvent);
      } else {
        window.removeEventListener('scroll', handleUserEvent);
      }
    }
  };

  // Start animating scroll
  requestID = requestAnimationFrame(step);
}