window.addEventListener('load', init);

function init(){
	headerInit();
	embedInit();
	window.addEventListener('scroll', scrollEvents);
}

function scrollEvents(){
	addClassHeaderOnBackground();
}