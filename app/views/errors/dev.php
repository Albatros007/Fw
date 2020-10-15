<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap-3/css/bootstrap.min.css">

    <title></title>
  </head>
  <body>
      
      <div class="container">
          
          <?php
          switch ($errType) {
            case 'notice':
                echo '<h1 class="text-success">Предупреждение</h1>';
                break;
            case 'fatal':
                echo '<h1 class="text-danger">Критическая ошибка</h1>';
                break;
            case 'exeption':
                echo '<h1 class="text-warning">Исключение</h1>';
            break;
          }
          ?>
                    
          <b>Номер:</b> <?= $errNo ?>
          <br />
          <b>Описание:</b> <?= $errStr ?>
          <br />
          <b>Файл:</b> <?= $errFile ?>
          <br />
          <b>Строка:</b> <?= $errLine ?>
          
          <hr />
          
      </div>
    
  </body>
</html>