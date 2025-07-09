<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('<?php echo e(route('dashboard.user.check.payment')); ?>')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    });
</script>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/includes/subscription-status.blade.php ENDPATH**/ ?>