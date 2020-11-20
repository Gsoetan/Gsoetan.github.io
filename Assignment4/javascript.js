
// Assignment part A functions

function getInputs() {
	var input_arr = [];
	var num_of_employees = 0; // will auto update as user enters in entries
	var hourly_pay = 15;
	var overtime_pay = (1.5 * 15);
	var hours_worked = 0;
	var company_total_pay = 0;
	while(hours_worked != -1){
		hours_worked = prompt("How many hours?");
		if (hours_worked == -1) { break; }
		num_of_employees++;
		var total_pay = 0;
		if (hours_worked > 40) { // check pay for each employee
			var overtime_hours = hours_worked - 40;
			total_pay = (overtime_pay * overtime_hours) + (40 * hourly_pay);
		} else {
			total_pay = hours_worked * hourly_pay;
		}

		input_arr.push(num_of_employees + ";" + hours_worked + ";$" + total_pay);
		company_total_pay += total_pay;
	}

	var table = document.createElement("TABLE");
	table.setAttribute("id", "Table");
	document.body.appendChild(table);

	var headers = "Employee_ID;Total_Hours;Total_Pay";
	createRow(headers, 0);


	for (var i = 0; i < input_arr.length; i++) {
		createRow(input_arr[i], i+1);
	}

	var total_row = "Company_total:; ;$" + company_total_pay;
	createRow(total_row, "_total");
}

function createRow(employee_data, index) {
	data_arr = employee_data.split(";"); // create an array of employee data

	// Create row for table
	var row = document.createElement("TR");
	row.setAttribute("id", "TableRow" + index);
	document.getElementById("Table").appendChild(row);

	// create entries for each row (Employee number, hours worked, total pay)
	// employee number
	var data1 = document.createElement("TD");
	var data_entry1 = document.createTextNode(data_arr[0]);
	data1.appendChild(data_entry1);
	document.getElementById("TableRow" + index).appendChild(data1);

	// hours worked
	var data2 = document.createElement("TD");
	var data_entry2 = document.createTextNode(data_arr[1]);
	data2.appendChild(data_entry2);
	document.getElementById("TableRow" + index).appendChild(data2);

	// total pay for the period
	var data3 = document.createElement("TD");
	var data_entry3 = document.createTextNode(data_arr[2]);
	data3.appendChild(data_entry3);
	document.getElementById("TableRow" + index).appendChild(data3);
}

// Assignment part B functions

function clearElement(elemId) {
	document.getElementById(elemId).innerHTML = '';
}

function startGuessingGame() {
	num_to_guess = Math.floor((Math.random() * 100) + 1); //number between 1 and 100
	guesses_limit = 3; // set guess limit
}

function gameOver(user_guess, answer){
	if (guesses_limit == 0) {
		alert("You've run out of guesses. The correct answer was: " + answer);
		startGuessingGame();
		document.getElementById("let_me_go_pls").style.visibility = "visible";
		document.getElementById("signon").reset();
		clearElement("guess_err");

		clearInterval(timeinterval);
		current_time = Date.parse(new Date());
		deadline = new Date(current_time + timer_for*60*1000);
		start_timing("timer",deadline);

		return true;
	}

	if (user_guess == answer){
		alert("You've guessed correctly! You win!");
		correct_sound.play();
		startGuessingGame();
		document.getElementById("let_me_go_pls").style.visibility = "visible";
		document.getElementById("signon").reset();
		clearElement("guess_err");

		clearInterval(timeinterval);
		current_time = Date.parse(new Date());
		deadline = new Date(current_time + timer_for*60*1000);
		start_timing("timer",deadline);

		return true;
	}

	return false;
}

function checkGuess(user_guess) {
	var answer = num_to_guess; //num_to_guess

	var end = gameOver(user_guess, answer);

	if (end) { return process.exit(1); }

	if (user_guess < num_to_guess) {
		document.getElementById("signon").reset();
		printError("guess_err", "Too low try again. Guesses remaining: " + guesses_limit);
		wrong_sound.play();
		guesses_limit -= 1;
	}

	if (user_guess > num_to_guess) {
		document.getElementById("signon").reset();
		printError("guess_err", "Too high try again. Guesses remaining: " + guesses_limit);
		wrong_sound.play();
		guesses_limit -= 1;
	}
}

function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

function sound(sound_obj) {
	this.sound = document.createElement("audio");
	this.sound.src = sound_obj;
    document.body.appendChild(this.sound);
	this.play = function(){ this.sound.play(); }
}

var timeinterval = setInterval(update_clock,1000);

function countDown(endtime){
	var total_time = Date.parse(endtime) - Date.parse(new Date());
	var seconds = Math.floor((total_time/1000) % 60);
	var minutes = Math.floor((total_time/1000/60) % 60);
	return {'total':total_time, 'minutes':minutes, 'seconds':seconds};
}

function start_timing(elemId,endtime){
	var timer = document.getElementById(elemId);
	function update_clock(){
		var time = countDown(endtime);
		timer.innerHTML = "Time left: " + formatTime(time.minutes)+':'+formatTime(time.seconds);
		if(time.total<0){ 
			clearInterval(timeinterval);
			alert("You've run out of time. The correct answer was: " + num_to_guess);
			document.getElementById("let_me_go_pls").style.visibility = "visible";
			startGuessingGame();
			current_time = Date.parse(new Date());
			deadline = new Date(current_time + timer_for*60*1000);
			start_timing("timer",deadline);
		}
	}
	update_clock(); // run once remove lag
	timeinterval = setInterval(update_clock,1000); // timer to show time counting down
}

function formatTime(number) {
	if (number <= 9) { number = "0" + number; }
	return number;
}


