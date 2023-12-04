<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carservice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <noscript>This app needs javascript.</noscript>
     <!--if somewhy form is activating, i dont wana send name or id with 'get' method
      DONT REMOVE METHOD="post"-->
    <form method="post" class="row">
      <div class="col-4">
        <label for="clientNameSearch" class="form-label">Client name</label>
        <input type="text" id="clientNameSearch" class="form-control" placeholder="John">
      </div>
      <div class="col-4">
        <label for="clientIdSearch" class="form-label">Client ID</label>
        <input type="text" id="clientIdSearch" class="form-control" placeholder="123456789">
      </div>
      <div id="searchButton" class="col-1">
        <button class="btn btn-primary">Search</button>
      </div>
      <div id="clearButton" class="col-2">
        <button class="btn btn-danger">Clear Search</button>
      </div>  
    </form>
    <br>
    <table  id="clientList" class="table table-dark table-striped"></table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('js/validateSearchInputs.js') }}"></script>
    <script src="{{ asset('js/sendSearchInputs.js') }}"></script>
    <script src="{{ asset('js/listCarsForClient.js') }}"></script>
    <script src="{{ asset('js/listServicesForCar.js') }}"></script>
    <script src="{{ asset('js/listClients.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>