<?php
    require_once('serv_inc.php');
    session_start();
    $song ='0';
    $dontShow = "none";
?>

<div class='refreschTop'>
    <?php
        $koek = $_COOKIE["key"];

        $status = file_get_contents('https://rest.freeinternetradio.nl/STATUS.txt', true);
        $_SESSION['status'] = $status;

        db_conn(); 

        $dag = date("N");
        if($dag == 7){$dag = 0;}
 
        $dagnummer = "&". $dag;
        $TijdNu = date("H:i:s");
    
        $event = $pdo->prepare('SELECT * FROM events WHERE day LIKE ?  AND enabled = True and time <= ? ORDER BY time desc limit 1');
        $event->execute(["%".$dagnummer."%", date('H:i')]);  

            while ($rownu = $event->fetch(PDO::FETCH_ASSOC))
            {
                    $DJses = $rownu['name'];
                    $_SESSION['id'] = $DJses;
                    $DJ = $_SESSION['id'];

            }

       ?>
    <player-top>
        <?php
        //echo $DJ;
        if($_COOKIE["key"] == 'none'){$dontShow = 'block';}else{$dontShow = 'none';}
        if($status == '24/7'){     
            ?>
                <div class='art'>
                    <img class='cover' height='300' width='300' src='images/fotocol/<?php echo $DJ; ?>.jpg'>
                    <!--<img class='cover' src='images/fotocol/platenkast.jpg' >-->
                    <!--<img class='cover' src='images/fotocol/mixer.jpg' >-->
                    <div class='overlay'><?php echo file_get_contents('https://freeinternetradio.nl/images/fotocol/'. $DJ .'.txt', true);?></div>
                </div>
                <div class='on' style='display: <?php echo $dontShow; ?>'>
                    <?php
                        switch ($DJ) {               
                            case "FIR":
                                echo "ON AIR <BR/> 24/7 <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgBleu' title='Mute audio van Free Internet Radio'><i class='bi bi-volume-mute'></i></button>";
                            break;
                            case "into the country":
                                echo "ON AIR <BR/> Into the Country <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                            break;
                            case "avondjass":
                                echo "ON AIR <BR/> Avond Jass <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                            break;
                            case "Ochtend":
                                echo "ON AIR <BR/> De Ochtend Show <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgBleu' title='Mute audio van Free Internet Radio'><i class='bi bi-volume-mute'></i></button>";
                            break;
                            case "Middag":
                                echo " ON AIR <BR/> De Middag Show <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgBleu' title='Mute audio van Free Internet Radio'><i class='bi bi-volume-mute'></i></button>";
                            break;
                            case "Avond":
                                echo "ON AIR <BR/> De Avond Show <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgBleu' title='Mute audio van Free Internet Radio'><i class='bi bi-volume-mute'></i></button>";
                            break;
                            case "Nacht":
                                echo "ON AIR <BR/> De Nacht Show <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgBleu' title='Mute audio van Free Internet Radio'><i class='bi bi-volume-mute'></i></button>";
                            break;
                            case "headlines":
                                echo "ON AIR <BR/> De Headlines <BR/>";
                            break;
                            case "nieuws":
                                echo "Het <BR/> Radio nieuws <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgRed' title='Mute audio van Free Internet Radio'><i class=' bi-volume-mute'></i></button>";
                            break;
                            case "Eind":
                                echo "ON AIR <BR/> 24/7 <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                            break;
                            case "Stilte":
                                echo "2 min <BR/> STILTE <BR/><p style='font-size:67%;'>";
                                echo "<div class='special'>2 min stilte ivm dodenherdenking</div>";
                            break;
                            case "noDJ":
                                echo "ON AIR <BR/> special <BR/><p style='font-size:67%;'>";
                                echo "<div class='special'>Helaas geen programma</div>";
                            break;
                            default:
                                echo "ON AIR <BR/> 24/7 <BR/>";
                                echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht Free Internet Radio'><i class='bi bi-chat-dots'></i></button>";
                                echo "<button class='button mute_btn bgRed' title='Mute audio van Free Internet Radio'><i class=' bi-volume-mute'></i></button>";
                        }
                    
        } 
        else
        {
            ?>
            <div class='art'>.
                <!--<img class='cover' src='images/fotocol/platenkast.jpg' >-->
                <img class='cover' height='300' width='300' src='images/fotocol/<?php echo $status; ?>.jpg'>
            </div>
            <?
            echo "<div class='on' style='display: $dontShow'>";
            switch ($status) {
                case "Wilbert":
                    $DJ = "Wilbert";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Wilbert <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    //echo "<button class='button videoBtn bgOrange' title='Kijk in de studio LIVE'><i class='bi bi-camera-video'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                break;
                case "Walter":
                    $DJ = "Walter";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Walter <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                break;
                case "Feiko":
                    $DJ = "Feiko";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Feiko <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                break;
                case "Maarten":
                    $DJ = "Maarten";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Maarten <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                break;
                case "Erik":
                    $DJ = "Erik";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Erik <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                break;
                case "Arno":
                    $DJ = "Arno";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Arno <BR/>";
                    echo "<button class='button verzoekBtn bgBleu' title='Stuur een bericht naar de DJ'><i class='bi bi-chat-dots'></i></button>";
                    echo "<button class='button bgGreen appBtn' title='Bel de DJ via 085-0601111'><i class='bi bi-telephone'></i></button>";
                    //echo "<button class='button videoBtn bgOrange' title='Kijk in de studio LIVE'><i class='bi bi-camera-video'></i></button>";
                break;
                case "Joerie":
                    $DJ = "Joerie";
                    //echo "<div class='video' id='twitch-embed' style='display:block'></div>";
                    //echo "<div id='on' style='display: $dontShow'>";
                    echo "LIVE DJ <BR/> Joerie <BR/><p style='font-size:67%;'>";
                    echo "<button class='button verzoekBtn'>Stuur bericht naar Joerie</button>";
                break;
            }
        }
            ?> 
                </div>
                <div class="stream" id="playAudioBtn" style="display:<?php echo $koek; ?> ">
                    <span title="klik en Luister naar Free Internet Radio "><i class="bi-play-fill"></i></span>
                </div>

    </player-top>
<!--</div>
<div class='refreschBot'>-->
    <player-bottom>
        <?php

            $json_url = "https://stream.freeinternetradio.nl:8443/status-json.xsl";
            $json = file_get_contents($json_url);
            $data = json_decode($json);
        
            echo "<hr/>";

            $stmt = $pdo->prepare('SELECT * FROM history Where song_type = ? ORDER BY date_played DESC  limit 1');
            $stmt->execute([$song]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($_SESSION['status'] == '24/7'){   
                echo "<b>" . $row['artist'] ."</b><br/>";
                echo $row['title'];
            }else{
                if($_SESSION['status'] == '24/7'){
                    $data2= explode("-", $data->icestats->source[0]->title);
                    $dataclean2 = str_replace(chr(194)," ", $data2);
                    echo "<b>". $dataclean2[0] ."</b><br/>";
                    echo $dataclean2[1] ;
                }else{
                    $data3= explode("-", $data->icestats->source[1]->title);
                    $dataclean3 = str_replace(chr(194)," ", $data3);
                    echo "<b>". $dataclean3[0] ."</b><br/>";
                    echo $dataclean3[1] ; 
                }    
            }

            echo "<i id='thumbs-down-btn' value='".$row['trackID']."' class='re bi-hand-thumbs-down'></i><i id='thumbs-up-btn' value='".$row['trackID']."' class='re bi-hand-thumbs-up'></i>";     
            //echo "artist";
            echo "<br/>";
            echo "<hr/>";

            $stmt = $pdo->prepare('SELECT * FROM history Where song_type = ? ORDER BY date_played DESC  limit 1,6');
                $stmt->execute([$song]);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<b style='font-size:90%;'> " . htmlspecialchars($row['artist'], ENT_QUOTES) . "</b>" ;
                    echo "<br/>" . htmlspecialchars($row['title'],ENT_QUOTES) . "<br/>" ;
                }
            $pdo = null;
        ?> 

    </player-bottom> 
</div> 