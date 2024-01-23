<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <img class="contact_header" src="<?php echo get_stylesheet_directory_uri() . '/assets/contact_header.png'; ?>" alt="Contact">
        <p><br>Formulaire de contact ici<br></p>
        <?php echo do_shortcode('[contact-form-7 id="6205389" title="Contact form 1"]'); ?>
      </div>
    </div>
  </div>
</div>