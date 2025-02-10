<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="contact-form">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" required placeholder="Tu nombre">
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required placeholder="Tu email">
    
    <label for="message">Mensaje:</label>
    <textarea name="message" id="message" required placeholder="Tu mensaje"></textarea>
    
    <button type="submit" class="submit-btn">Enviar</button>
</form>