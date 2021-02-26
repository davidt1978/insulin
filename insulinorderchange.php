<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Insulin Medical Order Dosing</title>
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
        <h1>Insulin Medical Order Dosing Change</h1>
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
          $currentBG  = $_POST['currentBG'];
          $previousBG = $_POST['previousBG'];
          $currentRate = $_POST['infusionRate'];


          $difference = $currentBG - $previousBG;
          // testing for bad input
          if (empty($currentBG) or empty($previousBG) or empty($currentRate))
              print ("Error: Input is missing!");
          elseif (!is_numeric($currentBG) or !is_numeric($previousBG) or !is_numeric($currentRate))
              print ("Error: Non-numeric input found!");
          elseif ($currentBG < 70)
              print ("<p class=alert>If blood suger <70, initiate hypolycemia protocol.<br>This protocol is NOT recommended for patients experiencing a diabetic emergency such as DKA or hyperglycemic hyperosmolar states.</p>");
          elseif ($currentBG <100)
              print ("<p class=alert>If BG < 100 mg/dL, turn insulin infusion off and recheck BG every hour until > 180 mg/dL.<br>Then restart insulin at 50% of most recent rate.</p>");
          else
          {
          if (($currentBG >= 140 and $currentBG <=179 and $difference > 50) or 
          ($currentBG >= 180 and $currentBG <= 250 and $difference > 0 ) or 
          ($currentBG >= 251 and $currentBG <= 400 and $difference > -25))
              {
                  if ($currentRate < 3)
                      $rateChange = 1;
                  elseif ($currentRate <= 6)
                      $rateChange = 2;
                  elseif ($currentRate <= 9.5)
                      $rateChange = 3;
                  elseif ($currentRate <= 14.5)
                      $rateChange = 4;
                  elseif ($currentRate <= 19.5)
                      $rateChange = 6;
                  elseif ($currentRate <= 24.5)
                      $rateChange = 8;
                  else 
                  { 
                      $rateChange = 10;
                      print ("<h2>CONSULT PRESCIBER</h2>");
                  }
              }
          elseif (($currentBG >= 140 and $currentBG <=179 and $difference >= 30 and $difference <= 50) or 
                  ($currentBG >= 180 and $currentBG <= 250 and $difference > -25) or 
                  ($currentBG >= 251 and $currentBG <=400 and $difference <= -25 and $difference >= -50))
              {
                  if ($currentRate < 3)
                      $rateChange = 0.5;
                  elseif ($currentRate <= 6)
                      $rateChange = 1;
                  elseif ($currentRate <= 9.5)
                      $rateChange = 1.5;
                  elseif ($currentRate <= 14.5)
                      $rateChange = 2;
                  elseif ($currentRate <= 19.5)
                      $rateChange = 3;
                  elseif ($currentRate <= 24.5)
                      $rateChange = 4;
                  else
                      $rateChange = 5;
              }
          elseif (($currentBG >= 100 and $currentBG <=139 and $difference > 0) or 
                  ($currentBG >= 140 and $currentBG <= 159 and $difference < 30 and $difference > -20) or 
                  ($currentBG >= 160 and $currentBG <= 179 and $difference < 30 and $difference > -30) or 
                  ($currentBG >= 180 and $currentBG <= 250 and $difference <= -25 and $difference >= -50) or 
                  ($currentBG >= 251 and $currentBG <= 400 and $difference <= -51 and $difference >= -75))
              {
                  $rateChange = 0;
              }
          elseif (($currentBG >= 100 and $currentBG <= 139 and $difference == 0) or 
                  ($currentBG >= 140 and $currentBG <= 159 and $difference <= -20 and $difference >= -50) or 
                  ($currentBG >= 160 and $currentBG <= 179 and $difference <= -30 and $difference >= -50) or 
                  ($currentBG >= 180 and $currentBG <= 250 and $difference <= -51 and $difference >= -75) or 
                  ($currentBG >= 215 and $currentBG <= 400 and $difference <= -75 and $difference >= -100))
              {
                  if ($currentRate < 3)
                      $rateChange = -0.5;
                  elseif ($currentRate <= 6)
                      $rateChange = -1;
                  elseif ($currentRate <= 9.5)
                      $rateChange = -1.5;
                  elseif ($currentRate <= 14.5)
                      $rateChange = -2;
                  elseif ($currentRate <= 19.5)
                      $rateChange = -3;
                  elseif ($currentRate <= 24.5)
                      $rateChange = -4;
                  else
                      $rateChange = -5;
              }
          elseif (($currentBG >= 100 and $currentBG <= 139 and $difference < 0) or 
                  ($currentBG >= 140 and $currentBG <= 159 and $difference < -50) or 
                  ($currentBG >= 160 and $currentBG <= 179 and $difference < -50) or 
                  ($currentBG >= 180 and $currentBG <= 250 and $difference < -75) or 
                  ($currentBG >= 215 and $currentBG <= 400 and $difference < -100))
              {
                  print ("<p class=alert> Hold infusion for 1 hour. Recheck BG. If BG > 180 mg/dL continue with change. </p>");
                  if ($currentRate < 3)
                      $rateChange = -1;
                  elseif ($currentRate <= 6)
                      $rateChange = -2;
                  elseif ($currentRate <= 9.5)
                      $rateChange = -3;
                  elseif ($currentRate <= 14.5)
                      $rateChange = -4;
                  elseif ($currentRate <= 19.5)
                      $rateChange = -6;
                  elseif ($currentRate <= 24.5)
                      $rateChange = -8;
                  else
                  {
                      $rateChange = -10;
                      print ("<h2>CONSULT PRESCRIPER</h2>");
                  }
              }

          $newRate = $currentRate + $rateChange;

          print ("<p>The Current BG is: $currentBG mg/dL.</p>
          <p>The Previous BG was: $previousBG mg/dL.</p>
          <p>The Difference in BG is: $difference mg/dL.</p>
          <p>The current infusion rate is: $currentRate ml/hr.</p>
          <p>The change in rate is: $rateChange ml/hr.</p>
          <p><h2>The new infusion rate is: $newRate ml/hr.</h2></p>");
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
