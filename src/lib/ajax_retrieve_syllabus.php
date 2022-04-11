<?php

namespace andyp\theme\syllabus\lib;

use andyp\theme\syllabus\lib\statics;

/**
 * ajax_search
 * 
 * Note that the AJAX methods are located in the
 * hook_actions/ajax_search.php file.
 * 
 * help from: 
 * https://code.mukto.info/wordpress-ajax-search-without-plugin/
 * https://stackoverflow.com/questions/55936919/wordpress-ajax-live-search-without-jquery
 * https://wordpress.stackexchange.com/questions/274983/turn-jquery-ajax-request-into-xmlhttprequest-vanilla-javascript
 * 
 */
class ajax_retrieve_syllabus {

    public $variables;

    public $output;


    public function __construct()
    {
        add_action('wp_footer', [$this, 'ajax_fetch'] );
    }


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


        ob_start();

            foreach($this->variables["acf"]["syllabus_items"] as $loop_index => $loop_item){

                $item_image = get_the_post_thumbnail($loop_item,null,['class' => 'w-full h-full'] );
                $item_excerpt = wp_trim_words( get_the_excerpt($loop_item), $num_words = 20, $more = null );
                $item_roman_index = statics::numberToRoman($loop_index+1);
                ?>

                <div class="path_item w-full rounded-xl bg-zinc-800 hover:bg-amber-500 text-zinc-100 hover:text-zinc-900 flex flex-row gap-2 h-32 p-4 cursor-pointer" data-post_id="<?php echo $loop_item->ID; ?>">
                    <div class="w-1/4"><?php echo $item_image; ?></div>
                    <div class="w-3/4 flex flex-col justify-center">
                        <div class="text-lg"><span class="text-emerald-500"><?php echo $item_roman_index; ?>.</span> <?php echo $loop_item->post_title; ?></div>
                        <div class="text-zinc-500 font-thin text-xs"><?php echo $item_excerpt; ?></div>
                    </div>
                </div>

                <?php
            }

        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }


    /**
     * Javascript to process the form.
     * 
     * Sends data to the hook_actions/ajax_search.php file
     * Specifically the wp_ajax_data_fetch() and the
     * wp_ajax_nopriv_data_fetch() functions.
     * 
     *
     * @return void
     */
    public function ajax_fetch() {
        ?>

            <script type="text/javascript">


                function fetch_syllabus_post(item){
                
                    var request = new XMLHttpRequest();
                    request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                    request.onload = function () {
                        if (this.status >= 200 && this.status < 400) {
                            document.getElementById('path_item_content').innerHTML = this.response;
                        } else {
                            console.log(this.response);
                        }
                    };

                    request.onerror = function() {
                        console.log('onerror');
                    };

                    request.send('action=syllabus_post&id='+item.dataset.post_id);

                }


                document.querySelectorAll('.path_item').forEach(item => {
                    item.addEventListener('click', event => {
                        fetch_syllabus_post(item);
                    })
                })

            </script>
        
        <?php
    }


}
