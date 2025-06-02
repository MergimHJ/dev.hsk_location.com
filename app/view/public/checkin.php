<?php
if($data['error'] ?? false){
    echo '<p>' . $data['error'] . '</p>';
}
?>

<form action="/checkin" method="POST">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <button type="submit">CHECKIN</button>
</form>