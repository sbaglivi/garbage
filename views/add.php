<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method="POST" action="/add">
    <label for="type">Garbage type:</label>
    <select name="type" required>
      <option value="Organic">Organic</option>
      <option value="Plastic">Plastic</option>
      <option value="Paper">Paper</option>
      <option value="Glass">Glass</option>
    </select>
    <label for="startTime">Starting time:</label>
    <select name="startTime" required>
      <?php
      for ($i = 0; $i < 37; $i++) {
        $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
        echo ("<option value='$time'>$time</option>");
      }
      ?>
    </select>
    <label for="endTime">Ending time:</label>
    <select name="endTime" required>
      <?php
      for ($i = 0; $i < 37; $i++) {
        $time = str_pad(6 + intdiv($i, 2), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($i % 2) * 30, 2, "0", STR_PAD_LEFT);
        echo ("<option value='$time'>$time</option>");
      }
      ?>
    </select>
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
    <button>Submit</button>
  </form>

</body>

</html>