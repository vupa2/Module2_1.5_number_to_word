<?php
function readOneDigit($num)
{
  $array = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
  return $array[$num];
}

function readTwoDigit($num)
{
  $teen = [10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen", 15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"];
  $ty = [2 => "twenty", 3 => "thirty", 4 => "fourty", 5 => "fifty", 6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety"];
  
  if ($num < 20) {
    return $teen[$num];
  } else {
    if ($num[1] == 0) {
      return $ty[$num[0]];
    } else {
      return $ty[$num[0]] . " " . readOneDigit($num[1]);
    }
  }
}

function readThreeDigit($num)
{
  if (($num % 100) == 0) {
    return readOneDigit($num[0]) . " hundred";
  } else if ($num[1] == 0) {
    return readOneDigit($num[0]) . " hundred and " . readOneDigit($num[2]);
  } else {
    return readOneDigit($num[0]) . " hundred and " . readTwoDigit($num[1] . $num[2]);
  }
}

function readNumber($num)
{
  $result = '';
  if (is_numeric($num)) {
    $num = (string)intval($num);
    switch (strlen($num)) {
      case 1:
        $result = readOneDigit($num);
        break;
      case 2:
        $result = readTwoDigit($num);
        break;
      case 3:
        $result = readThreeDigit($num);
        break;
      default:
        $result = 'out of ability';
    }
  } else {
    $result = 'out of ability';
  }
  
  return $result;
}

$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $num = $_POST['numInput'] ?? null;
  $result = ucfirst(readNumber($num));
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>[Bài tập] Ứng dụng đọc số thành chữ</title>
  <style>
    form > * {
      display: block;
      margin: 20px 0;
    }
    input[name="numInput"] {
      width: 500px;
    }
  </style>
</head>
<body>
  <h2>[Bài tập] Ứng dụng đọc số thành chữ</h2>
  <form method="POST">
    <label for="numInput">Enter a number between 0 and 100</label>
    <input type="number" name="numInput" id="numInput"/>
    <input type="submit" id="submit" value="Submit"/>
  </form>
  <h4><?= $result; ?></h4>
</body>
</html>
