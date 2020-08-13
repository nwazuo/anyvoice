<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="bootstrap.min.css" rel="stylesheet" />
  <title>Subscribe</title>
</head>

<body>
  <div class="container">
    <h1 class="display-1">Subscribe to Newsletter</h1>
    <form>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" aria-describedby="sendTo" name="email" />
      </div>
      <input type="hidden" id="op" name="op" value="subscribe" />
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="bootstrap.min.js"></script>
  <script>
  const form = document.querySelector('form');

  form.addEventListener('submit', function(e) {
    const email = document.querySelector('#email').value;

    e.preventDefault();
    fetch('./subscribe.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json', // sent request
          Accept: 'application/json', // expected data sent back
        },
        body: JSON.stringify({
          email
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