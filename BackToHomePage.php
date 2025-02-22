<?php @session_start();?>
<form id="postForm" action="index.php" method="POST" style="display: none;">
    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
    <input type="hidden" name="User" value="<?= $_SESSION['User']; ?>">
</form>
<script>
    function sendPostRequest() {
        document.getElementById("postForm").submit(); // Submit the form on click
    }
</script>