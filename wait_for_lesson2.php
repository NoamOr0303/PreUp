<!DOCTYPE html>
<html>
<head>
	<title>PreUp - המתנה לשיעור</title>
	<style type="text/css">
		body {
			background-color: #fcf7ed;
			font-family: Arial, sans-serif;
		}

		.container {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 30vh;
		}

		.clock {
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: center;
			font-size: 5rem;
			font-weight: bold;
			color: #523b2c;
			background-color: #f2d8a7;
			padding: 1rem;
			border-radius: 10px;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		}


		@media screen and (max-width: 600px) {
			.container {
			display: block;
			height: 30vh;
		}

			.clock {
    				flex-direction: column;
					align-items: center;
					justify-content: center;
  				}
		}


		.clock div {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin: 0 0.5rem;
			padding: 0.5rem;
			background-color: #f8eedf;
			border-radius: 5px;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		}

		.clock div span {
			font-size: 1.5rem;
			font-weight: normal;
			color: #7b4c37;
		}



	</style>

<script>


//const txtOutput = document.getElementById("txtOutput");
const bearerToken = "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";

// Translates ChatGPT response in English to Hebrew
// (Because ChatGPT reponse in English is better)
function translateToHebrewAndStoreInLocalStorage(textToTranslate, localStorageKey) {
  
	
  //const txtOutput = document.getElementById("txtQuestion");
  //const textToTranslate = txtQuestion.value;
  const targetLanguage = "he";

  let eli_google_api_key = "AIzaSyA0QP-Hc1tuOUpeW_gCZd5iPmx7_9ZiEbs";

  fetch(`https://translation.googleapis.com/language/translate/v2?key=${eli_google_api_key}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      q: textToTranslate,
      target: targetLanguage
    })
  })
  .then(response => response.json())
  .then(data => {
    const translatedText = data.data.translations[0].translatedText;
    //txtOutput.value = translatedText;
	//localStorage.setItem("chatGptResponseInHebrew", translatedText);
	
	localStorage.setItem(localStorageKey, translatedText);
  })
  .catch(error => console.error(error));
}


async function askChatGpt(sQuestion) {
  const selLang = "en-US";
  const sModel = "text-davinci-003";
  const iMaxTokens = 2048;
  const sUserId = "1";
  const dTemperature = 0.5;
  const stop = ["#", ";"];

  let chatGptResponse = "";		

  const data = {
    model: sModel,
    prompt: sQuestion,
    max_tokens: iMaxTokens,
    user: sUserId,
    temperature: dTemperature,
    frequency_penalty: 0.0,
    presence_penalty: 0.0,
    stop: stop,
  };

  const response = await fetch("https://api.openai.com/v1/completions", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "Authorization": `Bearer ${bearerToken}`,
    },
    body: JSON.stringify(data),
  });

  const jsonResponse = await response.json();

  //if (txtOutput.value != "") txtOutput.value += "\n";

  if (jsonResponse.error && jsonResponse.error.message) {
    alert(`Error: ${jsonResponse.error.message}`);
  } else if (jsonResponse.choices && jsonResponse.choices[0].text) {
    let s = jsonResponse.choices[0].text;

    if (selLang.value != "en-US") {
      const a = s.split("?\n");
      if (a.length == 2) {
        s = a[1];
      }
    }

    //if (s == "") s = "No response";
    //txtOutput.value += `Chat GPT: ${s}`;

	chatGptResponse = s;
  }


  //if (txtOutput.value != "") txtOutput.value += "\n";
  //txtOutput.value += `Me: ${sQuestion}`;
  localStorage.setItem("chatGptReponseOrig", chatGptResponse);
  console.log("Calling translateToHebrewAndStoreInLocalStorage(sQuestion). sQuestion is:\n ", sQuestion);
  translateToHebrewAndStoreInLocalStorage(chatGptResponse, "chatGptResponseInHebrew");

  let requestForQuiz = "Write a multipe choice quiz of one question. " +
  					"The question should have three options as possible answers. " +
  					 "Each question and each option should end with <br/>. " +
					 "The quiz should be about this text: " +  chatGptResponse;
  askChatGptForMultiOptionsQuiz(requestForQuiz);
}


async function askChatGptForMultiOptionsQuiz(sQuestion) {
  const selLang = "en-US";
  const sModel = "text-davinci-003";
  const iMaxTokens = 2048;
  const sUserId = "1";
  const dTemperature = 0.5;
  const stop = ["#", ";"];

  let chatGptResponse = "";		

  const data = {
    model: sModel,
    prompt: sQuestion,
    max_tokens: iMaxTokens,
    user: sUserId,
    temperature: dTemperature,
    frequency_penalty: 0.0,
    presence_penalty: 0.0,
    stop: stop,
  };

  const response = await fetch("https://api.openai.com/v1/completions", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "Authorization": `Bearer ${bearerToken}`,
    },
    body: JSON.stringify(data),
  });

  const jsonResponse = await response.json();

  //if (txtOutput.value != "") txtOutput.value += "\n";

  if (jsonResponse.error && jsonResponse.error.message) {
    alert(`Error: ${jsonResponse.error.message}`);
  } else if (jsonResponse.choices && jsonResponse.choices[0].text) {
    let s = jsonResponse.choices[0].text;

    if (selLang.value != "en-US") {
      const a = s.split("?\n");
      if (a.length == 2) {
        s = a[1];
      }
    }

    //if (s == "") s = "No response";
    //txtOutput.value += `Chat GPT: ${s}`;

	chatGptResponse = s;
  }


  //if (txtOutput.value != "") txtOutput.value += "\n";
  //txtOutput.value += `Me: ${sQuestion}`;
  localStorage.setItem("chatGptQuizOrig", chatGptResponse);
  
  console.log("Calling translateToHebrewAndStoreInLocalStorage(sQuestion). sQuestion is:\n ", sQuestion);
  translateToHebrewAndStoreInLocalStorage(chatGptResponse, "chatGptQuizInHebrew");

  
}


</script>


</head>
<body dir="rtl">

    <div style="margin: 0 auto; width: 95%;">
			<div class="mb-4">
				<img src="img/preup_logo.png" style="width: 255px; height: 80px;"/>
			</div>
			<p>המתן להודעה הלימודית הבאה</p>

			<div class="container" dir="ltr">
				<div class="clock">
					<div>
						<span id="days">0</span>
						<span>Days</span>
					</div>
					<div>
						<span id="hours">0</span>
						<span>Hours</span>
					</div>
					<div>
						<span id="minutes">0</span>
						<span>Minutes</span>
					</div>
					<div>
						<span id="seconds">0</span>
						<span>Seconds</span>
					</div>
				</div>
			</div>
	</div>	

    <script>

	// While the clock ticks on the screen, we ask chatGPT the question
	// user typed-in on the first screen.
	// ChatGpt reqponse is then saved into localstorage as "chatGptResponseInHebrew"
	let questionToChatGpt = localStorage.getItem("questionToChatGpt")
	askChatGpt(questionToChatGpt);


    // Set the date we're counting down to
//var countDownDate = new Date("May 10, 2023 12:00:00").getTime();
var targetDate = new Date();
targetDate.setSeconds(targetDate.getSeconds() + 12);  // Clock counts 10 seconds (chatGpt responds to user question at this time)
console.log(targetDate);
var countDownDate = targetDate.getTime();

// Update the countdown every second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the countdown date
  var distance = countDownDate - now;

  // Calculate days, hours, minutes and seconds remaining
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the countdown timer in the corresponding divs
  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML = seconds;

  // If the countdown is finished, display "EXPIRED"
  if (distance < 0) {
    clearInterval(x);
    //document.getElementById("countdown").innerHTML = "EXPIRED";
	window.location.href = "summary.php";
  }
}, 1000);

</script>

</html>
