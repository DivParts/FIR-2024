<?php
  setlocale(LC_ALL,'nl_NL.ISO8859-1');
  session_set_cookie_params(['SameSite' => 'Lax', 'secure' => true]);

  session_start();

  if (isset($_COOKIE['key'])) {
    unset($_COOKIE['key']);
    setcookie('key', "lul", 1, '/',['samesite'=>'lax', 'secure' => true]);
  }
 
  require_once('serv_inc.php');

  $dagnummer = date("N")+3;
  $dagnaam = date("D");
  $toDate = date("Y-m-d");
  $now = date("Y-m-d H:i:s");
  $PRGname = "none";
  $count = "werkt";
    
?>
<!DOCTYPE html>
<html lang="nl">

  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stream">
    <meta name="author" content="Feiko van de Velde">

    <title>Free Internet Radio</title>

    <link rel="apple-touch-icon" sizes="180x180" href="images/png/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/png/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/png/favicon-16x16.png">

    <link rel="stylesheet" href="css/flex.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <script src="js/jquery v3.7.1.js"></script>
    <script src="js/fir.js"></script>
  </head>

<body class="text-center">

  <header>
    <i class="li bi bi-list"></i>
      <div id="stationName">
        <?php echo $stationName;?>        
      </div>
  </header> 
  
  <geheel>
    <div class="player">
      <?require_once('live_stat.php');?>
    </div>
    
    <div class="info">
      <reclame>
        <promo>
          <?require_once('promo.php');?>
        </promo>
        <blog>
          <?require_once('blog.php');?>
        </blog>
      </reclame>

      <dj-fir>

        <modal-dj style="display:none;">
          <div id="fotoverhaal"></div>
        </modal-dj>

        <modal-blog style="display:none;">
          <div id="blogverhaal"></div>
        </modal-blog>

        <div class="titel-tekst"><H2>Het FIR team</H2></div>
        <?php
        db_conn();

        $team = $pdo->prepare('SELECT DJ_image,DJ_ID,DJ_name,foto_tekst FROM dj WHERE DJ_enable = ? ');
        $team->execute([1]);
      
        while ($row = $team->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='fotocol a'>";
              echo "<div class='contfoto'>";
                echo "<img  class='djfoto' src='images/dj/".$row['DJ_image']."'>";
                echo "<div class='tekstfotomid' id='btn-ShowModalDj' value='".$row['DJ_ID']."'>";
                    echo $row['DJ_name']."<br/>";
                    echo $row['foto_tekst']."<br/>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
        }   
        $pdo = null;
        ?>

        <div class="tekstfoto"></div>
        
      </dj-fir>

      <?php
        db_conn();

          $front = $pdo->prepare('SELECT * FROM front WHERE front_ID = ?');
          $front->execute([1]);

          $row = $front->fetch(PDO::FETCH_ASSOC);

          $pdo = null;
      ?>

      <div>
          <span class="tabflap tf1"> <? echo $row['front_tab1name'];?></span> 
          <span class="tabflap tf2"> <? echo $row['front_tab2name'];?></span>
          <span class="tabflap tf3"> <? echo $row['front_tab3name'];?></span>
      </div>
      <article-raam> 
        <div class="tabblad tb1">
          &nbsp &nbsp
          <? echo $row['front_tab1text'];?>
        </div>

        <div class="tabblad tb2">
          &nbsp &nbsp
          <? echo $row['front_tab2text'];?>
        </div>

        <div class="tabblad tb3">
          &nbsp &nbsp
          <? echo $row['front_tab3text'];?>
        </div>
      </article-raam>

      <live-programmas>
        <div class="titel-tekst"><H2>De Live Programma's</H2></div>

        <div class="fotocol">
          <div class="tekstdag">Maandag 16:00-17:00</div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/nachtrok.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam" value="103">
                Road Rock <br/>
                Met <br/>
                Feiko v.d. Velde
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">Woensdag 20:00-22:00</div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/Avondblouse.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam" value="106">
                Avond blouse<br/>
                met<br/>
                Erik Ramaker                
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">Donderdag 20:00-22:00</div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/www.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam" value="102">
                De WWW <br/>
                Met <br/> Wilbert Kooi
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">Zaterdag 20:00-24:00</div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/platenkoffer 1e.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam" value="106">
                De Platenkoffer<br/>
                met<br/>
                Maarten Herygers                
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">Zondag 19:00-21:00</div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/Discotrain.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam" value="106">
                Discotrain<br/>
                met<br/>
                Walter van Peene                
              </div>
            </div>
          </div>
        </div>
    
        <fototekstraam style="display:none;">
          <div class="close"><i class="re bi bi-x-lg" id="btn-close"></i></div>
          <div id="fotoverhaal"></div>
        </fototekstraam>
      </live-programmas>

      <non-stop>
        <div class="titel-tekst"><H2>De Non-stop programma's</H2></div>
        <div class="fotocol">
          <div class="tekstdag">
            Maandag t/m zondag <br/>
            0:00 - 6:00
          </div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/nacht.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam">
                De NachtShow <br/>
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">
            Maandag t/m zondag <br/>
            6:00 - 12:00
          </div>
          <div class="contfoto">
            <img  class="dagfoto" src='images/fotocol/ochtend.jpg'>
            <div class="tekstfotomid">
              <div class="tekstfoto" id="btn-ShowFotoTekstRaam">
                De OchtendShow <br/>
              </div>
            </div>
          </div>
        </div>
        <div class="fotocol">
          <div class="tekstdag">
            Maandag t/m zondag <br/>
            12:00 - 18:00
          </div>              
            <div class="contfoto">
              <img  class="dagfoto" src='images/fotocol/middag.jpg'>
              <div class="tekstfotomid">
                <div class="tekstfoto" id="btn-ShowFotoTekstRaam">
                  De MiddagShow <br/>
                </div>
              </div>
            </div>
        </div>          
        <div class="fotocol">
          <div class="tekstdag">
            Maandag t/m zondag <br/>
            18:00 - 24:00
          </div>
            <div class="contfoto">
              <img  class="dagfoto" src='images/fotocol/avond.jpg'>
              <div class="tekstfotomid">
                <div class="tekstfoto" id="btn-ShowFotoTekstRaam">
                  De AvondShow <br/>
                </div>
              </div>
            </div>
        </div>
      </non-stop> 

      <links>
        <?php require_once('link.php'); ?>
      </links>

      <footer>
        <?php require_once('footer.php'); ?>
      </footer>
      
    </div><!--main-->

    <div id="bericht">

    </div>

      <modal-thumbs-up style="display:none;">
        <div class="close"><i class="re bi bi-x-lg" id="btn-close"></i></div>
        Fijn hij zal vaker te horen zijn op Free Internet Radio
      </modal-thumbs-up>

      <modal-thumbs-down style="display:none;">
        <div class="close"><i class="re bi bi-x-lg" id="btn-close"></i></div>
        Jammer we zullen deze plaat minder gaan draaien op Free Internet Radio
      </modal-thumbs-down>

      <phoneNumber style="display:none;">
        <div class="close"><i class="re bi bi-x-lg" id="btn-close"></i></div>
        <br/>
        Bel met de studio <strong>LIVE</strong> <br/>
        085-0601111
      </phoneNumber>

  </geheel>

  <audio id="stream" >
    <source src="https://stream.freeinternetradio.nl:8443/main.mp3" type="audio/mpeg" >
  </audio>

</body>

</html>


