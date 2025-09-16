<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreUp - סיכום החומר</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        H1 {
            color: rgb(46, 131, 243);
            font-size: 24px;
        }
    </style>

	<script>
		function handleRequest()
		{
			//alert("בטיפול");
			Swal.fire({
				position: 'top-start',
				icon: 'success',
				title: 'מתחילים בחינה',
				showConfirmButton: false,
				timer: 3000
			});

			setTimeout(() => {
				window.location.href = "quiz.php";				
			}, 3500);
		}
	</script>

</head>
<body dir="rtl">
    <div style="margin: 0 auto; width: 95%;">
        <div class="mb-4">
			<img src="img/preup_logo.png" style="width: 255px; height: 80px;"/>
        </div>
		<h1>סיכום החומר</h1>
		<div id="txtSummary" rows="10" 
				style="margin-top: 30px; width: 100%; background-color: #cccccc; min-height: 400px;">
			זה הסיכום של החומר
			<br/>
			כאן המשך הסיכום
		</div>
        <button type="button" class="btn btn-primary mt-4" onclick="handleRequest();">המשך לבחינה</button>
		<!-- <button onclick="askChatGpt(document.getElementById('txtQuestion').value);">שלח</button> -->




	</div>    

</body>


<script>

	document.getElementById("txtSummary").innerHTML = localStorage.getItem("chatGptResponseInHebrew");

</script>


</html>