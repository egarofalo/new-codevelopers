<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\site_title;
?>
<div class="site-title">
    <div class="container-xxl">
        <?php echo apply_filters('wpelementor_site_title', site_title(false)) ?>
    </div>
</div>