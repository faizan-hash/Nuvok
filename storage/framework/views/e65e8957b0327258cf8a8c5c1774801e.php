<?php
    $base_class =
        'lqd-navbar-label inline-block max-w-full overflow-hidden text-ellipsis pb-navbar-link-pb ps-navbar-link-ps ps-navbar-link-ps pt-navbar-link-pt text-4xs uppercase tracking-widest lg:group-[&.navbar-shrinked]/body:w-full lg:group-[&.navbar-shrinked]/body:px-2 lg:group-[&.navbar-shrinked]/body:text-center';
?>

<span <?php echo e($attributes->withoutTwMergeClasses()->twMerge($base_class, $attributes->get('class'))); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH /var/www/Novuk/resources/views/default/components/navbar/label.blade.php ENDPATH**/ ?>