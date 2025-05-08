<?php
if (isset($data['message'])) {
    echo '<p>' . $data['message'] . '</p>';
}

?>

<form action="/contact/send" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?= $data['post_data']["name"]; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" placeholder="Enter your email" value="<?= $data['post_data']["email"]; ?>">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" class="form-control" rows="4" placeholder="Enter your message"><?= $data['post_data']["message"]; ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>