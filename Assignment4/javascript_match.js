// Assignment part C functions

 // For 8 card game
const cardArray8 = [
{'name':'img1', 'image':'photos/image001.gif'},
{'name':'img2', 'image':'photos/image002.gif'},
{'name':'img3', 'image':'photos/image003.gif'},
{'name':'img4', 'image':'photos/image004.gif'},
{'name':'img5', 'image':'photos/image005.gif'},
{'name':'img6', 'image':'photos/image006.gif'},
{'name':'img7', 'image':'photos/image007.gif'},
{'name':'img8', 'image':'photos/image008.gif'}];
// For 10 card game
const cardArray10 = [
{'name':'img1', 'image':'photos/image001.gif'},
{'name':'img2', 'image':'photos/image002.gif'},
{'name':'img3', 'image':'photos/image003.gif'},
{'name':'img4', 'image':'photos/image004.gif'},
{'name':'img5', 'image':'photos/image005.gif'},
{'name':'img6', 'image':'photos/image006.gif'},
{'name':'img7', 'image':'photos/image007.gif'},
{'name':'img8', 'image':'photos/image008.gif'},
{'name':'img9', 'image':'photos/flower.jpg'},
{'name':'img10', 'image':'photos/dove.png'}];
 // For 12 card game
const cardArray12 = [
{'name':'img1', 'image':'photos/image001.gif'},
{'name':'img2', 'image':'photos/image002.gif'},
{'name':'img3', 'image':'photos/image003.gif'},
{'name':'img4', 'image':'photos/image004.gif'},
{'name':'img5', 'image':'photos/image005.gif'},
{'name':'img6', 'image':'photos/image006.gif'},
{'name':'img7', 'image':'photos/image007.gif'},
{'name':'img8', 'image':'photos/image008.gif'},
{'name':'img9', 'image':'photos/flower.jpg'},
{'name':'img10', 'image':'photos/dove.png'},
{'name':'img11', 'image':'photos/heart.png'},
{'name':'img12', 'image':'photos/idk_maybe.png'}];

var firstClick = '';
var secondClick = '';
var last_clicked = null;
var count = 0;
const vanish_delay = 1000; //1 second(s)

const easy_timer = 2;
const medium_timer = 2.5;
const hard_timer = 3;

const memorize_time_easy = 3000;
const memorize_time_medium = 5000;
const memorize_time_hard = 8000;
var memorize_time = 0;

var gameGrid = null;
var grid_layout = null;
var deadline = null;
var num_to_win = 0;
var diff = '';

const game = document.getElementById('game');

function clearElement(elemId) {
	document.getElementById(elemId).innerHTML = '';
}

function sleep(ms) {
  return new Promise(wait => setTimeout(wait, ms));
}

async function startMatchingGame(difficulty){
	diff = difficulty;
	clearElement('instructions');
	clearElement('game');
	clearElement('timer');
	document.getElementById("winner").style.visibility = "hidden";
	grid_layout = document.createElement('section');
	switch(difficulty){
		case 'easy':
			gameGrid = cardArray8.concat(cardArray8);
			num_to_win = 16;
			memorize_time = memorize_time_easy;
			break;
		case 'moderate':
			gameGrid = cardArray10.concat(cardArray10);
			num_to_win = 20;
			memorize_time = memorize_time_medium;
			break;
		case 'hard':
			gameGrid = cardArray12.concat(cardArray12);
			num_to_win = 24;
			memorize_time = memorize_time_hard;
			break;
		default:
			gameGrid = cardArray8.concat(cardArray8);
			num_to_win = 16;
			memorize_time = memorize_time_easy;
	}

	gameGrid = shuffleArray(gameGrid);

	grid_layout.setAttribute('class', 'grid_layout');
	game.appendChild(grid_layout);

	gameGrid.forEach(formatCards);

	await sleep(memorize_time);
	let current_time = Date.parse(new Date());

	switch(difficulty){ // need to separate to get the user time to memorize
		case 'easy':
			deadline = new Date(current_time + easy_timer*60*1000);
			break;
		case 'moderate':
			deadline = new Date(current_time + medium_timer*60*1000);
			break;
		case 'hard':
			deadline = new Date(current_time + hard_timer*60*1000);
			break;
		default:
			deadline = new Date(current_time + easy_timer*60*1000);
	}

	start_timing("timer", deadline);

	grid_layout.addEventListener('click', onClickListener);
}

function shuffleArray(array) {
	let index = array.length; 
	let temp, random_index;

	while (0 != index){
		random_index = Math.floor(Math.random() * index);
		index -= 1;

		temp = array[index];
		array[index] = array[random_index];
		array[random_index] = temp;
	}
	return array;
}

function formatCards(item) {
	let card = null;
	switch(diff){ // need to separate to get the user time to memorize
		case 'easy':
			card = document.createElement('div');
			card.classList.add('cardEasy');
			card.dataset.name = item.name;
			break;
		case 'moderate':
			card = document.createElement('div');
			card.classList.add('cardMedium');
			card.dataset.name = item.name;
			break;
		case 'hard':
			card = document.createElement('div');
			card.classList.add('cardHard');
			card.dataset.name = item.name;
			break;
		default:
			card = document.createElement('div');
			card.classList.add('cardEasy');
			card.dataset.name = item.name;
	}

	let foreground = document.createElement('div');
	foreground.classList.add('foreground');

	let background = document.createElement('div');
	background.classList.add('background');
	background.style.backgroundImage = 'url('+item.image+')';

	grid_layout.appendChild(card);
	card.appendChild(foreground);
	card.appendChild(background);
}

function onClickListener() { // onClickListener
	let clicked = event.target;
	if (clicked.nodeName == 'section' || clicked == last_clicked) { return; }
	else if (clicked.parentNode.classList.contains('selected') || 
		clicked.parentNode.classList.contains('match')) { return; }
	if (count < 2) {
		count++;
		if (count == 1) {
			firstClick = clicked.parentNode.dataset.name;
			clicked.parentNode.classList.add('selected');
		} else {
			secondClick = clicked.parentNode.dataset.name;
			clicked.parentNode.classList.add('selected');
		}
		if (firstClick != '' && secondClick != '') {
			if (firstClick == secondClick) { 
				setTimeout(get_match, vanish_delay);
				gameOver();
			}
			setTimeout(reset_clicks, vanish_delay);
		}
		last_clicked = clicked;
	}
};

function get_match() {
	let selected = document.querySelectorAll('.selected');
	selected.forEach((card) => { card.classList.add('match'); });
}

function gameOver() {
	let matches = document.getElementsByClassName('match');
	let num_matches = matches.length + 2;
	// document.getElementById("results").innerHTML = num_matches;  //used for debugging
	if (num_matches == num_to_win) {
		document.getElementById("results").innerHTML = "You win!";
		document.getElementById("timer").style.visibility = "hidden";
		clearElement('game');
		document.getElementById("winner").style.visibility = "visible";
		setTimeout(() => { window.location.reload(); }, 5000);
	} else { return; }
}

function reset_clicks() {
	firstClick = secondClick = '';
	count = 0;

	let selected = document.querySelectorAll('.selected');
	selected.forEach((card) => { card.classList.remove('selected'); });
}

var timeinterval = setInterval(update_clock,1000);

function countDown(endtime){
	let total_time = Date.parse(endtime) - Date.parse(new Date());
	let seconds = Math.floor((total_time/1000) % 60);
	let minutes = Math.floor((total_time/1000/60) % 60);
	return {'total':total_time, 'minutes':minutes, 'seconds':seconds};
}

function start_timing(elemId,endtime){
	let timer = document.getElementById(elemId);
	function update_clock(){
		let time = countDown(endtime);
		timer.innerHTML = "Time left: " + formatTime(time.minutes)+':'+formatTime(time.seconds);
		if(time.total<=0){ 
			clearInterval(timeinterval);
			document.getElementById("timer").innerHTML = "Time's up!";
			clearElement('game');
			setTimeout(() => { document.getElementById("timer").innerHTML = "Play again?";}, 2000);
		}
	}
	update_clock(); // run once remove lag/hiccups
	timeinterval = setInterval(update_clock,1000); // timer for the timer
}

function formatTime(number) {
	if (number <= 9) { number = "0" + number; }
	return number;
}
