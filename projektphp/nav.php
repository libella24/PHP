<!-- 
           
           <nav>
        
                <ul>
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="leistungen.html">Leistungen</a></li>
                    <li><a href="oeffnungszeiten.html">Öffnungszeiten</a></li>
                    <li><a href="kontakt.html">Kontakt</a></li>
                </ul>
            </nav>
          -->
          
          <?php

          // Unveränderlichen Code übergeben - assoziatives Array
          // =====================================================

          // key = Seite/Dateiname, Value= angezeigter Wert im Nav-Bar

          $nav_punkte = array(
            "home" => "Startseite",
            "leistungen" => "Leistungen",
            "oeffnungszeiten" => "Öffnungszeiten",
            "kontakt" => "Kontakt"
          );
          echo "<nav><ul>";

          // Struktur 

          // foreach ($nav_punkte as $key => $value) {
          //   href... 
          // }

          // Listeneintrag dynamisch erstellen (bezieht sich auf Site-Namen in der index.php)

          foreach ($nav_punkte as $href => $nav_punkt) { // foreach --> alle Navigationspunkte sollen durchiteriert werden.
            echo '<li ';
            if ($site == $href) echo 'class="active"'; //wenn die Seite die aufgerufene ist, 
            // dann soll der Text" class=active" verwendet werden. 
            // $site = das, was in die URL geschrieben wird
            echo '><a href="?seite=';
            echo $href . '">' . $nav_punkt; //Zugriff auf Index (z.B "home" und auf den Wert (z.B. "Startseite))
            echo "</a></li>";
          }

          echo "</ul></nav>";


         
          
      
