<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    td {
      text-align: center;
      padding: .5rem;
    }

    .dark {
      background-color: black;
      color: white;
    }

    .light {

      background-color: white;
      color: black;
    }
  </style>
</head>

<body>
  <table>
    <tbody>
      <?php $number = 1 ?>
      <?php for ($y = 1; $y <= 8; $y++) : ?>
        <tr>
          <?php for ($x = 1; $x <= 8; $x++) : ?>
            <td class=<?= ($number % 3 === 0 || $number % 4 === 0) ? 'light' : 'dark' ?>>
              <?= $number ?>
            </td>
            <?php $number++ ?>
          <?php endfor; ?>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</body>

</html>