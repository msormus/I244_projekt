<!doctype HTML>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="Stiil.css">
      <title>Dokumendiregister</title>
   </head>
   <body>
      <h1>Register</h1>
      <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
         <input type="hidden" name="action" value="logout">
         <button type="submit">Logi välja</button>
      </form>
      <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
         <input type="hidden" name="action" value="muuda">
         <input type="hidden" name="id" value="<?= $dok['id'] ?>">
         <table>
            <tr>
               <td>Number</td>
               <td><input type="text" name="number" id="number" 
                  value="<?= htmlspecialchars($dok['Number']) ?>"></td>
            </tr>
            <tr>
               <td>Nimetus</td>
               <td><input type="text" name="nimetus" id="nimetus" 
                  value="<?= htmlspecialchars($dok['Nimetus']) ?>"></td>
            </tr>
            <tr>
               <td>Kategooria</td>
               <td>
                  <select name="kategooria">
                     <option value=""> --Vali nimekirjas-- </option>
                     <?php foreach(kategooria_model_load() as $rida): ?>
                     <option value="<?= $rida['id']; ?>"
                        <?php if($dok['Kategooria'] == $rida['id']) : ?>
                        selected
                        <?php endif; ?>	
                        >
                        <?= htmlspecialchars($rida['Nimetus']); ?>
                     </option>
                     <?php endforeach; ?>      	
                  </select>
               </td>
            </tr>
         </table>
         <p> <button type="submit">Muuda rida</button> </p>
      </form>
   </body>
</html>