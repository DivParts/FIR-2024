
<?php
require_once('serv_inc.php');
session_start();
?>

<div id="mailto" >
        
<div class="fcf-body">
  <div class="close"><i class="re bi bi-x-lg" id="btn-close"></i></div>

  <div id="fcf-form">
    <h3 class="fcf-h3">Stuur je berichtje of verzoekplaat naar <?php echo $_SESSION['status'];?></h3> 

    <form id="emailform" class="fcf-form-class" method="post">

    <input type="radio" name="keuzeBericht" id="keuze1" checked="checked" value="keuze1">Verzoekplaat
    <input type="radio" name="keuzeBericht" id="keuze2" value="keuze2">Bericht
        
      <div class="fcf-form-group">
          <div class="fcf-input-group">
            <input type="text" id="Name" name="Name" placeholder="Naam" class="fcf-form-control" required>
            <input type="email" id="Email" name="Email" placeholder="Jouw email adress" class="fcf-form-control" required>
          </div>
        
          <div id="keuzeOff" style="display:none">
            <label for="Message" class="fcf-label">plaats een berichtje?</label>
              <div class="fcf-input-group">
                <textarea type="tekst" id="Message1" name="Message1" class="fcf-form-control" rows="6" maxlength="3000"></textarea>
              </div>
          </div>    
      

            <div id="keuzeOn" >
              <label for="Message" class="fcf-label">Artiest naam?</label>
                <div class="fcf-input-group">
                  <input type="tekst" id="Message" name="Message" class="fcf-form-control">
                </div>
              <label for="Title" class="fcf-label">Titel van de plaat?</label>
                <div class="fcf-input-group">
                  <input type="tekst" id="Title" name="Title" class="fcf-form-control">
                </div>
            </div>
        </div>
      
          <input type="hidden" id="Emailto" name="Emailto" value="<?php echo $_SESSION['status'] ;?>">
          <input type="hidden" id="Datum" name="Datum" value="<?php echo $now ;?>">
          <button type="submit" id="fcf-button" name="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block"><i class="bi-send"></i></button>
        </div>
      </div>
      <div id="server-results"><!-- For server results --></div>

    </form>
  </div>
</div>

</div>