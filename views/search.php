<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="views/assets/js/search.js" defer></script>
  <link rel="stylesheet" href="views/assets/css/main.css">
  <link rel="stylesheet" href="views/assets/css/search.css">
</head>

<body>
  <a href="/">Back to the home page</a>
  <h1>Search for a pickup</h1>
  <form id="searchForm" method="GET" action="/api/search">
    <div class="input-div">
      <label for="type">Garbage type:</label>
      <select name="type">
        <option value="">Any</option>
        <option value="Organic">Organic</option>
        <option value="Plastic">Plastic</option>
        <option value="Paper">Paper</option>
        <option value="Glass">Glass</option>
      </select>
    </div>
    <div class="input-div">
      <label for="weekday">Weekday:</label>
      <select name="weekday">
        <option value="">Any</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
      </select>
    </div>
    <div class="input-div">
      <label for="id">ID:</label>
      <input type="number" min="0" name="id">
    </div>
    <button>Search</button>
  </form>
  <button id="todayButton">Check today pickups</button>
</body>

</html>