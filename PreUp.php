<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         #canvas {
            display: block;
            /* margin: auto;
            margin-top: 50px; */

            border: 2px solid black;
          }
    </style>
</head>
<body dir="rtl">
    <div style="margin: 0 auto; width: 50%;">
        <div class="mb-4">
			<img src="img/preup_logo.png" style="width: 255px; height: 80px;"/>
        </div>
        <p>המתן הודעה הלימודית הבאה</p>
        <canvas id="canvas" width="300" height="100"></canvas>
</body>

<script>
    // Set the countdown date and time
    const countdownTargetDate = new Date("May 3, 2023 23:30:00").getTime();
    console.log("countdownTargetDate:", countdownTargetDate);      

    // Get the canvas element and its context
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    // Set the font and text alignment for the timer
    ctx.font = "4em monospace";
    ctx.textAlign = "center";

    // Update the countdown every second
    const countdownInterval = setInterval(() => {
    // Get the current date and time
    const now = new Date().getTime();
    console.log("now:", now);      

    // Calculate the time remaining until the countdown date and time
    const timeRemaining = countdownTargetDate - now;

    // Calculate hours, minutes, and seconds from the time remaining
    // const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    // const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    // const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);


    // Clear the canvas before redrawing the timer
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the time remaining in the countdown timer
    ctx.fillText(`${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`, canvas.width / 2, canvas.height / 1.5);

    // If the countdown is over, stop updating the countdown and display a message
    if (timeRemaining < 0) {
        clearInterval(countdownInterval);
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillText("EXPIRED", canvas.width / 2, canvas.height / 2);
    }
    }, 1000);
</script>
</html>
