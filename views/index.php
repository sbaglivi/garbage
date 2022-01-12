<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <table>
    <tr><th>Id</th><th>Type</th><th>Weekday</th><th>Start time</th><th>End time</th></tr>
    <tbody>
    <?php foreach ($data as $collectionTime): ?>
      <tr><td><?=$collectionTime->id?></td><td><?=$collectionTime->type?></td><td><?=$collectionTime->weekday?></td><td><?=$collectionTime->startTime?></td><td><?=$collectionTime->endTime?></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>