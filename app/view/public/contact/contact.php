<?php
// Vérifiez si $data existe avant d'essayer d'y accéder
if(isset($data) && is_array($data)) {
    echo '<div class="alert alert-success">
            <strong>Merci pour votre message!</strong> ' . $data['message'] . '
          </div>';
}
?>

<form method="post" action="">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5"><?php echo isset($data['message']) ? $data['message'] : ''; ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>