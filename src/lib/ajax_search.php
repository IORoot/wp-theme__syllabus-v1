<?php

namespace andyp\theme\syllabus\lib;

class ajax_search {


    public $variables;

    public $output;


    /**
     * Set all variables.
     *
     * @param array $variables      
     * @return void
     */
    public function set_variables(array $variables)
    {
        $this->variables = $variables;
    }


    /**
     * Run the functions in order
     *
     * @return void
     */
    public function output()
    {
        $this->add_javascript();
        $this->add_ajax_javascript();


        ob_start();
            
            ?>
                <form action="/" method="get" autocomplete="off" class="-ml-3 flex flex-row bg-white font-thin rounded overflow-hidden">
                    <input type="text" name="s" placeholder="Search Syllabus..." id="keyword" class="input_search inline-block pl-10 p-4 " onkeyup="fetch()">
                    <button> Search </button>
                    <a href="#open-search-modal" >open results</a>
                </form>
            <?php

            $this->modal();

        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }



    public function add_javascript()
    {
        add_action( 'wp_footer', [$this, 'ajax_fetch'] );
    }

    public function ajax_fetch() {
        ?>

            <script type="text/javascript">
            function fetch(){
            
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: { action: 'data_fetch', keyword: jQuery('#keyword').val() },
                    success: function(data) {
                        jQuery('#datafetch').html( data );
                    }
                });
            
            }
            </script>
        
        <?php
    }

    

    public function add_ajax_javascript()
    {
        add_action('wp_ajax_data_fetch' , [$this,'data_fetch']);
        add_action('wp_ajax_nopriv_data_fetch',[$this,'data_fetch']);           
    }

    public function data_fetch(){

        $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => array('page','post') ) );
        if( $the_query->have_posts() ) :
            echo '<ul>';
            while( $the_query->have_posts() ): $the_query->the_post(); ?>
    
                <li><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></li>
    
            <?php endwhile;
            echo '</ul>';
            wp_reset_postdata();  
        endif;
    
        die();
    }


    /**
     * Create a modal for the post image
     *
     * @return void
     */
    public function modal()    
    {
        ?>
        <div data-modal id="open-search-modal" class="group z-50 fixed inset-0 items-center justify-center target:flex opacity-0 target:opacity-100 invisible target:visible transition-opacity" >
            <div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-sm p-4 rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100">

            <div class="search_result" id="datafetch">
                <ul>
                    <li>Please wait..</li>
                </ul>
            </div>

                <a href="#" class="absolute top-1 right-1">
                    <svg class="w-6 h-6"><use xlink:href="#close"></use></svg>
                </a>
            </div>
            <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>
        </div>

        <?php
    }

}
