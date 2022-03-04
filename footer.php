<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <div>
        <div> &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></div>
        <div><?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?></div>
    </div>
</footer><!-- end #footer -->

<?php $this->footer(); ?>

<?php $this->need('./js/control.js'); ?>
</body>
</html>
