<?php

namespace andyp\theme\syllabus\lib;


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
class ajax_search {


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
            
            ?>
                <a href="#open-search-modal" class="-ml-3 pl-12 pr-8 py-1.5 h-8 flex flex-row gap-2 bg-white hover:bg-zinc-300 hover:text-white hover:fill-white font-thin text-sm text-zinc-400 fill-zinc-400 rounded overflow-hidden">
                    <svg class="svg-inherit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/></svg>
                    <div>Quick Search</div>
                </a>
            <?php

            $this->modal();

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
            function fetch(){
            
                var request = new XMLHttpRequest();
                request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                request.onload = function () {
                    if (this.status >= 200 && this.status < 400) {
                        console.log(this.response);
                        document.getElementById('datafetch').innerHTML = this.response;
                    } else {
                        console.log(this.response);
                    }
                };

                request.onerror = function() {
                    console.log('onerror');
                };

                var data = document.getElementById('keyword').value;
                // request.send(data);
                request.send('action=data_fetch&keyword='+data);

            
            }
            </script>
        
        <?php
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
            <div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-sm rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100">

                <form action="/" method="get" autocomplete="off" class="flex flex-row bg-white font-thin rounded-t-xl overflow-hidden relative" onsubmit="return false;">
                    <input type="text" name="s" placeholder="Search Syllabus..." id="keyword" class="inline-block px-14 py-4 w-full" onkeyup="fetch()">
                    <svg class="svg-inherit w-6 h-6 fill-zinc-400 absolute top-4 left-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/></svg>
                </form>

                <div class="p-4 flex flex-wrap gap-2" id="datafetch">
                    <div>Please wait..</div>
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
