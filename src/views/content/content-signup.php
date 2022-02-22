<article <?php post_class('px-8 pt-24'); ?>>

    <div class="flex flex-row">

        <?php the_content(); ?>
        <?php 
        
        /**
         * Bugfix
         * 
         * The [ 'user' => true ] needs to be set on the form because there is a check in
         * /advanced-forms-pro/pro/core/core-editing.php
         * Line 36 that checks for the existance of the 'user' key
         * 
         * 
         *  36 		if ( $form['editing']['user'] && isset( $args['user'] ) ) {
         *  37
		 *	38          $this->handle_user_edit( $form, $args['user'], $args );
		 *	39
		 *  40      }
         *
         * For some reason this is not set be default and ALWAYS fails if not set.
         * 
         */
        advanced_form( 'form_6213aeb19907e' , ['user' => true]); ?>

    </div>

</article>