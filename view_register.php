<!doctype HTML>
<html>
   <head>
      <meta charset="utf-8">
      <title>Dokumendiregister</title>
      <link rel="stylesheet" type="text/css" href="Stiil.css">
      <script src="skript.js"></script>
   </head>
   <body>
      <h1>Register</h1>
      <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
         <input type="hidden" name="action" value="logout">
         <button type="submit">Logi välja</button>
      </form>
      <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
         <input type="hidden" name="action" value="lisa">
         <table>
            <tr>
               <td>Number</td>
               <td><input type="text" name="number" id="number" value=""></td>
            </tr>
            <tr>
               <td>Nimetus</td>
               <td><input type="text" name="nimetus" id="nimetus" value=""></td>
            </tr>
            <tr>
               <td>Kategooria</td>
               <td>
                  <select name="kategooria">
                     <option value=""> --Vali nimekirjas-- </option>
                     <?php foreach(kategooria_model_load() as $rida): ?>
                     <option value="<?= $rida['id']; ?>">
                        <?= htmlspecialchars($rida['Nimetus']); ?>
                     </option>
                     <?php endforeach; ?>      	
                  </select>
               </td>
            </tr>
         </table>
         <p> <button type="submit">Lisa kirje</button> </p>
      </form>
      <table id="register" border="1">
         <thead>
            <tr>
               <th>Number</th>
               <th>Nimetus</th>
               <th>Kategooria</th>
               <th>Tegevused</th>
            </tr>
         </thead>
         <tbody>
            <?php
               foreach (model_load($kategooria) as $rida):
               ?>
            <tr>
               <td> <?= htmlspecialchars($rida['Number']) ?> </td>
               <td> <?= htmlspecialchars($rida['Nimetus']) ?></td>
               <td> 
                  <a href="<?= $_SERVER['PHP_SELF']?>?kategooria=<?= $rida['kat']?>">
                  <?= htmlspecialchars($rida['Kategooria']) ?>
                  </a>
               </td>
               <td>
                  <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                     <input type="hidden" name="action" value="kustuta">
                     <input type="hidden" name="id" value="<?= $rida['id']; ?>">
                     <a href="<?= $_SERVER['PHP_SELF'] ?>?view=edit&amp;id=<?= $rida['id'] ?>">Muuda</a>
                     <button type="submit">Kustuta</button>
                  </form>
               </td>
            </tr>
            <?php
               endforeach;
               
               ?>
         </tbody>
      </table>
      <?php if($kategooria ): ?>	
      <p>
         <a href="<?= $_SERVER['PHP_SELF']?>">Näita kõiki välju</a>
      </p>
      <?php endif; ?>	
   </body>
</html>