<?php

if (!isset($_SESSION['message'])) {
    return;
}

$type    = $_SESSION['message']['type'];
$title   = $_SESSION['message']['title'];
$content = $_SESSION['message']['content'];

?>
<script>
    swal('<?= $title ?>', '<?= $content ?>', '<?= $type ?>', {
        button: {
            className: 'bg-gradient-to-br from-indigo-500 to-indigo-800'
        }
    });
</script>

<?php unset($_SESSION['message']); ?>