<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<div id="main-wrapper">
<?php
do_action('get_header');
get_template_part('templates/header');
?>

<?php include roots_template_path(); ?>

<div class="bottom-footer-push"></div>
</div>
<?php get_template_part('templates/footer'); ?>

</body>
</html>
