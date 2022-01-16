<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="views/assets/js/index.js" defer></script>
  <link href="views/assets/css/main.css" rel="stylesheet">
  <link href="views/assets/css/index.css" rel="stylesheet">
</head>

<body>
  <a class="searchLink" href="/search">Go to the search page</a>
  <h2>Insert a new pickup time </h2>
  <form id="addForm" method="POST" action="/api/pickups">
    <div class="input-div">
      <label for="type">Garbage type:</label>
      <select name="type" required>
        <option value="Organic">Organic</option>
        <option value="Plastic">Plastic</option>
        <option value="Paper">Paper</option>
        <option value="Glass">Glass</option>
      </select>
    </div>
    <div class="input-div">
      <label for="startTime">Starting time:</label>
      <select name="startTime" required>
        <?php
        for ($i = 0; $i < 37; $i++) {
          $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
          echo ("<option value='$time'>$time</option>");
        }
        ?>
      </select>
    </div>
    <div class="input-div">
      <label for="endTime">Ending time:</label>
      <select name="endTime" required>
        <?php
        for ($i = 0; $i < 37; $i++) {
          $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
          echo ("<option value='$time'>$time</option>");
        }
        ?>
      </select>
    </div>
    <div class="input-div">
      <label for="weekday">Weekday:</label>
      <select name="weekday" required>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
      </select>
    </div>
    <button>Add</button>
    <p class="insertMessage" hidden></p>
  </form>
  <h2> Update a pickup time </h2>
  <form id="updateForm" method="PUT" action="/api/pickups">
    <div class="input-div">
      <label for="id">ID of pickup to update:</label>
      <input type="number" name="id" min="0" required>
    </div>
    <div class="input-div">
      <label for="type">Garbage type:</label>
      <select name="type" required>
        <option value="Organic">Organic</option>
        <option value="Plastic">Plastic</option>
        <option value="Paper">Paper</option>
        <option value="Glass">Glass</option>
      </select>
    </div>
    <div class="input-div">
      <label for="startTime">Starting time:</label>
      <select name="startTime" required>
        <?php
        for ($i = 0; $i < 37; $i++) {
          $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
          echo ("<option value='$time'>$time</option>");
        }
        ?>
      </select>
    </div>
    <div class="input-div">
      <label for="endTime">Ending time:</label>
      <select name="endTime" required>
        <?php
        for ($i = 0; $i < 37; $i++) {
          $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
          echo ("<option value='$time'>$time</option>");
        }
        ?>
      </select>
    </div>
    <div class="input-div">
      <label for="weekday">Weekday:</label>
      <select name="weekday" required>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
      </select>
    </div>
    <button>Update</button>
    <p class="updateMessage" hidden></p>
  </form>
  <h2>Delete a pickup time</h2>
  <form id="deleteForm" method="DELETE" action="/delete">
    <label for="id">ID of the pickup to be deleted:</label>
    <input type="number" min="1" name="id" required>
    <button>Delete</button>
    <p hidden class="deleteMessage"></p>
  </form>
  <h2>All pickups currently scheduled </2>
</body>

</html>