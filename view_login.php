<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="Stiil.css">
      <link rel="icon" type="image/png" href="logo.png" />
      <title>Dokumendiregister</title>
   </head>
   <body>
      <h1>Logi sisse</h1>
      	<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
         <input type="hidden" name="action" value="login">
         <ul class="menyy">
            <li><a href="https://www.riigiteataja.ee/akt/106012016007?leiaKehtiv">Seadusandlus</a></li>
            <li><a href="<?=$_SERVER['PHP_SELF']?>?view=help">Abi</a></li>
         </ul>
         <table class="tabel">
            <tr>
               <td><label for="username">Kasutajanimi</td>
               <td><input type="text" id="username" name="kasutajanimi"></td>
            </tr>
            <tr>
               <td><label for="pass">Parool</td>
               <td><input type="password" id="pass" name="parool"></td>
            </tr>
         </table>
         <button type="submit">Logi sisse</button>
      </form>
      <p>
         Sul ei ole kontot? <a href="<?=$_SERVER['PHP_SELF']?>?view=reg">Loo see SIIN</a>
      </p>
      <h2></h2>
      <img src="Documents.png" alt="Dokumendid">
   </body>
</html>