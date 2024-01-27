<div id="mailto" style="display:none">
          
  <div class="fcf-body">

    <div id="fcf-form">
      <h3 class="fcf-h3">Stuur je berichtje of verzoekplaat naar DJ <?php echo $DJ;?></h3> 

      <form id="emailform" class="fcf-form-class" method="post">

        <input type="radio" name="keuzeBericht" id="keuzeBericht" value="1">Verzoekplaat
        <input type="radio" name="keuzeBericht" id="keuzeBericht" value="2">Bericht
          
        <div class="fcf-form-group">
          <div class="fcf-input-group">
            <label for="Name" class="fcf-label">Naam</label>
              <input type="text" id="Name" name="Name" class="fcf-form-control" required>
            <label for="Email" class="fcf-label">Jouw email adress</label>
              <input type="email" id="Email" name="Email" class="fcf-form-control" required>
          </div>
        </div>

        <div class="fcf-form-group1" style="display:none" id="keuzeOff">
          <label for="Message" class="fcf-label">plaats een berichtje?</label>
            <div class="fcf-input-group">
              <textarea type="tekst" id="Message1" name="Message1" class="fcf-form-control" rows="6" maxlength="3000"></textarea>
            </div>
        </div>

        <div id="keuzeOn" >
          <div class="fcf-form-group1">
            <label for="Message" class="fcf-label">Artiest naam?</label>
              <div class="fcf-input-group">
                <input type="tekst" id="Message" name="Message" class="fcf-form-control">
              </div>
          </div>

          <div class="fcf-form-group1">
            <label for="Title" class="fcf-label">Titel van de plaat?</label>
              <div class="fcf-input-group">
                <input type="tekst" id="Title" name="Title" class="fcf-form-control">
              </div>
          </div>
        </div>

        <div class="fcf-form-group">
          <input type="hidden" id="Emailto" name="Emailto" value="<?php echo $DJ ;?>">
          <button type="submit" id="fcf-button" name="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Sturen</button>
        </div>
        <div id="server-results"><!-- For server results --></div>

      </form>
    </div>
  </div>

</div>