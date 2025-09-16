<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreUp</title>
    <style>
        H1 {
            color: rgb(46, 131, 243);
            font-size: 24px;
        }
    </style>
</head>
<body dir="rtl">
    <div style="margin: 0 auto; width: 50%;">
        <H1>PreUp</H1>
        <p>ברוכים הבאים לאפליקציה שלנו<br/>הכניסו את החומר למבחן:</p>
        <input id="txtQuestion" type="text" placeholder="שאלה לסוכן החכם"/>
        <button onclick="askChatGpt(document.getElementById('txtQuestion').value);">שלח</button>
		<textarea id="txtOutput" rows="10" style="margin-top: 10px; width: 100%;" 
         placeholder="תשובה של הסוכן החכם"></textarea>
    </div>    

</body>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<script>

const txtOutput = document.getElementById("txtOutput");
const bearerToken = "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";


function translateToEnglish() {
  const txtOutput = document.getElementById("txtOutput");
  const textToTranslate = txtOutput.value;
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
    txtOutput.value = translatedText;
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

  if (txtOutput.value != "") txtOutput.value += "\n";

  if (jsonResponse.error && jsonResponse.error.message) {
    txtOutput.value += `Error: ${jsonResponse.error.message}`;
  } else if (jsonResponse.choices && jsonResponse.choices[0].text) {
    let s = jsonResponse.choices[0].text;

    if (selLang.value != "en-US") {
      const a = s.split("?\n");
      if (a.length == 2) {
        s = a[1];
      }
    }

    if (s == "") s = "No response";
    txtOutput.value += `Chat GPT: ${s}`;
  }
  
  if (txtOutput.value != "") txtOutput.value += "\n";
  txtOutput.value += `Me: ${sQuestion}`;

  translateToEnglish();
}


</script>


</html>