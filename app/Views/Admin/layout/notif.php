<script type="text/javascript">
    let type        = <?= json_encode(session()->get('message.alert-type')) ?>;
    let message     = <?= json_encode(session()->get('message.message')) ?>;
    let gravity     = <?= json_encode(session()->get('message.gravity')) ?>;
    let position    = <?= json_encode(session()->get('message.position')) ?>;

    switch(type){
        case "primary":
            Toastify({
                text: message,
                duration: 5000,
                avatar: "<?= base_url('assets/cms/image/info.svg') ?>",
                newWindow: true,
                stopOnFocus: true,
                close: true,
                gravity: gravity,
                position: position,
                backgroundColor: "#0D6EFD",
            }).showToast();
            break;

        case "success":
            Toastify({
                text: message,
                duration: 5000,
                avatar: "<?= base_url('assets/cms/image/info.svg') ?>",
                close: true,
                gravity: gravity,
                position: position,
                backgroundColor: "#28A745",
            }).showToast();
            break;

        case "warning":
            Toastify({
                text: message,
                duration: 5000,
                avatar: "<?= base_url('assets/cms/image/info.svg') ?>",
                close: true,
                gravity: gravity,
                position: position,
                backgroundColor: "#FFC107",
            }).showToast();
            break;

        case "danger":
            Toastify({
                text: message,
                duration: 5000,
                avatar: "<?= base_url('assets/cms/image/info.svg') ?>",
                close: true,
                gravity: gravity,
                position: position,
                backgroundColor: "#DC3545",
            }).showToast();
            break;
    }
</script>
