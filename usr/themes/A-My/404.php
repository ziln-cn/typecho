<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div id="error-page" class="main_element">
    <section class="error-page-content" style="padding: 5rem;display: flex;align-items: center;justify-content: center;">
      <div class="error-box">
        <div class="error-body text-center" style="text-align: center;">
          <h1  style="font-size: 4rem;font-weight: 700;text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #868e96;letter-spacing: 5px;">404</h1>
          <h5 class="mb-5 mt-3 text-gray">File not found！</h5>
        </div>
      </div>
    </section>
</div>
	<?php $this->need('layout/footer.php'); ?>
