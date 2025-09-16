<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreUp - בחינה</title>

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
            Swal.fire({
				position: 'top-start',
				icon: 'success',
				title: 'ממתינים לשיעור הבא',
				showConfirmButton: false,
				timer: 3000
			});

			setTimeout(() => {
				window.location.href = "wait_for_lesson2.php";				
			}, 3500);

		}
	</script>

</head>
<body dir="rtl">
    <div style="margin: 0 auto; width: 95%;">
        <div class="mb-4">
			<img src="img/preup_logo.png" style="width: 255px; height: 80px;"/>
        </div>
		<h1>בחינה</h1>

        <div class="mt-4 p-2" style="margin-top: 30px; width: 100%; background-color: #cccccc;">
        <div class="form-check"> 
  <input type="radio" name="exampleRadios" id="exampleRadios1" value="תשובה ראשונה">
  <label for="exampleRadios1">
        תשובה ראשונה
  </label>
</div>
<div class="form-check">
  <input type="radio" name="exampleRadios" id="exampleRadios2" value="תשובה שנייה">
  <label for="exampleRadios2">
        תשובה שנייה
  </label>
</div>
<div class="form-check">
  <input type="radio" name="exampleRadios" id="exampleRadios3" value="תשובה שלישית">
  <label for="exampleRadios3">
     תשובה שלישית
  </label>
</div>

    </div>
        <button type="button" class="btn btn-primary mt-4" onclick="handleRequest();">סיום</button>
		<!-- <button onclick="askChatGpt(document.getElementById('txtQuestion').value);">שלח</button> -->

	</div>    

</body>



<script>


</script>


</html>