<?php
         

        $erfolg = false; // Ausgangspunkt: Es wurde keine Anfrage abgeschickt.
        $fehlermeldungen = array();

        // echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
        // print_r($fehlermeldungen); 
        // echo "</pre>";

        // Wurde das Formular abgeschickt?

           if (!empty($_POST))
           { // Trifft die if-Abfrage zu, dann wird POST-Request ausgeführt. 
            //Validierung: Wurden alle Felder ausgefüllt?
            if(empty($_POST["name"])) {
                $fehlermeldungen[] = "Bitte geben Sie den Namen ein.";
                
            } elseif (strlen($_POST["name"]) <=2) {
                $fehlermeldungen[] = "Erfassen Sie mehr als 2 Buchstaben.";
            }
            
            if(empty($_POST["email"])) {
                $fehlermeldungen[] = "Bitte geben Sie die E-Mail Adresse an.";  
            }elseif(!preg_match("/^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,15}$/", $_POST["email"])){
                $fehlermeldungen[] = "Bitte geben Sie eine gültige E-Mail Adresse an."; 
            }

            if(!empty($_POST["prueffeld"])){
                $fehlermeldungen[] = "Bitte das Prüffeld leer lassen.";

            }

            if(empty($_POST["message"])){
                $fehlermeldungen[] = "Bitte geben Sie eine Nachricht an.";
            }

            if (empty($fehlermeldungen)){
                $erfolg = true;

                $mail_inhalt = "Anfrage über Kontaktformular:
                Name:{$_POST["name"]}
                E-Mail:{$_POST["email"]}
                Nachricht:{$_POST["message"]}";

                // Anfraga in Server speichern (FILE_PUT_CONTENTS)
                // ================================================

                $dateiname = "mail_".date("Y-m-d_H-i-s");
                file_put_contents("mail_backup/{$dateiname}.txt", $mail_inhalt);

                // E-Mail versenden
                // =================

                mail("r.fleckl@me.com", "Kontaktanfrage Website von {$_POST["name"]}", $mail_inhalt);
                

                

        // echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
        // print_r($mail_inhalt); 
        // echo "</pre>";
            }
        }
           
?>
           
           <div class="text">
                <h1>Kontakt</h1>
                <div class="left">
                    <h2>Wifi Salzburg</h2>
                    <p>
                        Musterhausstraße 13<br />
                        5020 Salzburg<br />
                        Österreich<br />
                        <br />
                        0043-662-12345<br />
                        <a href="mailto:rainer.christian@gmx.at">rainer.christian@gmx.at</a><br />
                        <a href="http://www.wifisalzburg.at" target="_blank">www.wifisalzburg.at</a><br />
                        <br />
                        <br />
                        Oder einfach Formular ausfüllen, abschicken, fertig!<br />
                        Wir werden uns umgehend um Ihr Anliegen bemühen.
                    </p>
                </div>

                <!-- HIER BEGINNT DAS FORMULAR -->
                <div class="contact right">
                
                        <?php
                        if(!empty($fehlermeldungen)){ // die Variable Fehlermeldung wird nur ausgegeben, wenn die Fehlermeldung zutrifft. nicht-empty = $fehlermeldung trifft zu. (bisschen weired....)
                            echo "<strong> Folgender Fehler ist aufgetreten:</strong><br>";
                            // echo $fehlermeldung;
                            //Fehlerart-Array anlegen:
                        
                              echo "<ul>";
                
                              foreach ($fehlermeldungen as $fehlermeldung) {
                                echo "<li>". $fehlermeldung . "</li>";
                              }
                    
                              echo "</ul>";
                        }

                        //Erfolgemeldung ausgeben
                        //<!-- In der form hab ich die method=post, damit weiß das Programm, dass alle Elemente daruntinnerhalb dieser Form im Array (Form) enthalten sind 
                        //jeweils der Key ist das Array-Item, z.B. name, message, email, submit 


                        if ($erfolg) {
                            echo "<h3>Vielen Dank für Ihre Anfrage!</h3>";
                        }else {

                            ?>

                            <form action ="" method ="post"> 
                                <div>
                                    <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="<?php if (!empty($_POST["name"])){echo htmlspecialchars($_POST["name"]);}
                                    ?>" placeholder = "Name" required/>
                                </div>
                                <div>
                                    <input type="text" id="email" name="email" value="<?php
                                    if (!empty($_POST["email"])){echo htmlspecialchars($_POST["email"]);}?>" placeholder="E-Mail" />
                                </div>

                                <div>
                                    <input type="text" id="prueffeld" name="prueffeld" value="" placeholder="Dieses Feld leer lassen." />
                                </div>



                                <div>
                                    <textarea id="message" name="message" placeholder = "Ihre Nachricht"><?php if(!empty($_POST["message"])){echo htmlspecialchars($_POST["message"]);}?></textarea>
                                </div>
                                <div style="text-align: right;">
                                    <button type="submit" id="submit" name="submit">Absenden</button>
                                </div>
                            </form>
                            <?php
                        };?>
                
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
