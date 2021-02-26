<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Initial Insulin Medical Order Dosing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
  </head>

  <body>
    <div id="wrapper">
      <header role="banner">
        <h1>Initial Dosing</h1>
        <nav role="navigation">
          <ul>
            <li><a href="../index.html">Home Page</a></li>
            <li><a href="../insulin/initialdose.html">Initial Dose</a></li>
            <li><a href="../insulin/insulinorderchange.html">Order Change</a></li>
          </ul>
        </nav>
      </header>
      
      <main role="main">
        <?php
          $glucose = $_POST['glucose'];
        
          if (empty($glucose))
            print('<p>ERROR: Input is missing!</p>');
          elseif (!is_numeric($glucose))
            print('<p>ERROR: Non-numeric input found!</p>');
          elseif ($glucose > 400)
            print('<p class="alert">DO NOT use the protocol. Call prescriber</p>');
          elseif ($glucose < 70)
            print('<p class="alert">Initiate Hypoglycemia protocol. When BG is <70.</p>');
        
          if ($glucose >= 70 and $glucose < 150)
            print('<p class="alert">Consult prescriber before starting protocol due to low BG level.</p>');
        
          else {
            $infusionRate = $glucose/200;
            $infusionRate = round($infusionRate * 2)/2;
            print ("<p>Your initial glucose level is $glucose (mg/dL).</p>
            <p>The initial bolus is $infusionRate (units).</p>
            <p>The infusion rate is $infusionRate (units/hr). </p>");
          }
        ?>
      </main>
      
      <footer role="contentinfo">
        <p>This site was created and is maintained by David Truesdale.</p>
        <p>All feedback is welcomed at <a href="mailto:davidetruesdale@siteproject.online">davidetruesdale@siteproject.online</a>.</p>
        <p>Visit my personal site at <a href="http://www.siteproject.online">siteproject.online</a>.</p>
      </footer>
    </div>
  </body>
</html>
