<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="Stiil.css">
      <link rel="icon" type="image/png" href="logo.png" />
      <script src="skript2.js"></script>
      <title>Loo konto</title>
   </head>
   <body>
      <h1>Loo konto</h1>
      <form id="vorm2" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
         <input type="hidden" name="action" value="reg">
         <table class="tabel">
           <tr>
               <td>
                  <label for="username">
                     Kasutajanimi
               </td>
               <td><input type="text" id="username" name="kasutajanimi"></td>
            </tr>
            <tr>
            <td><label for="pass">Parool</td>
            <td><input type="password" id="pass" name="parool"></td>
            </tr>
            <tr>
            <td><label for="pass2">Parooli kordus</td>
            <td><input type="password" id="pass2" name="parool2"></td>
            </tr>                    
            <tr>
            <td colspan="2">
            <label>
            <input type="checkbox" name="tos">Nõustun kasutustingimustega</td>
            </label>
            </tr>              	 
         </table>
         <button type="submit">Loo konto</button>
      </form>
   </body>
</html>