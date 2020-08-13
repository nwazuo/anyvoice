<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="bootstrap.min.css" rel="stylesheet" />
		<title>SendMyMail</title>
	</head>
	<body>
		<div class="container">
			<h1 class="display-1">Swift Mailer</h1>
			<form method="POST" action="mailer.php">
				<div class="form-group">
					<label for="to">To</label>
					<input
						type="email"
						class="form-control"
						id="to"
						aria-describedby="sendTo"
						name="to"
					/>
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" class="form-control" id="subject" name="subject" />
				</div>
				<div class="form-group">
					<label for="body">Example textarea</label>
					<textarea
						class="form-control"
						id="body"
						rows="7"
						name="body"
					></textarea>
				</div>
				<input type="hidden" id="op" name="op" value="op" />
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<script src="bootstrap.min.js"></script>
		<script>
			const form = document.querySelector('form');

			form.addEventListener('submit', function (e) {
				const to = document.querySelector('#to').value;
				const subject = document.querySelector('#subject').value;
				const body = document.querySelector('#body').value;

				e.preventDefault();
				fetch('./mailer.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json', // sent request
						Accept: 'application/json', // expected data sent back
					},
					body: JSON.stringify({
						to,
						subject,
						body,
						op: 'op',
					}),
				})
					.then((res) => {
						return res.json();
					})
					.then((data) => console.log(data))
					.catch((error) => console.log(error));
			});
		</script>
	</body>
</html>
