<?php

namespace andyp\theme\syllabus\lib;

use mycred;

class mycred_checkbox {

    private $point_type = 'personal_tracking';

    private $mycred;
    private $user_id;
    private $variables;

    public function __construct()
    {
        $this->set_user_id();
        $this->set_mycred_object();
        $this->init_ajax_actions();
    }


    public function set_variables(array $variables)
    {
        $this->variables = $variables;
    }


    public function output()
    {
        ob_start();
        ?>

        <style>
            .favourite {
                visibility:hidden;
            }
            .favourite:before {
                content: "\2605";
                position: absolute;
                visibility:visible;
            }
            .favourite:checked:before {
                content: "\2606";
            }
        </style>
        <input class="favourite text-3xl cursor-pointer mt-4" type="checkbox" id="mycred_checkbox" name="mycred_checkbox" onclick="checkbox_state()" <?php if ($this->variables['mycred']['page_checked']){ echo 'checked'; } ?> >

        <?php
        $this->output = ob_get_contents();
        ob_end_clean();

        return $this->output;
    }



    private function set_user_id()
    {
        $this->user_ID = $GLOBALS["current_user"]->ID;
    }


    private function set_mycred_object()
    {
        $this->mycred = mycred( $this->point_type );
    }


    private function init_ajax_actions()
    {
        add_action('wp_footer', [$this, 'ajax_fetch'] );
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
                function checkbox_state(){
                
                    var request = new XMLHttpRequest();
                    request.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                    request.onload = function () {
                        if (this.status >= 200 && this.status < 400) {
                            console.log(this.response);
                            document.getElementById('mycred_checkbox').checked = this.response;
                        } else {
                            console.log(this.response);
                        }
                    };

                    request.onerror = function() {
                        console.log('onerror');
                    };

                    state = document.getElementById('mycred_checkbox').checked;
                    request.send('action=mycred_checkbox&state='+state+'&post_id=<?php echo $this->variables["current_object"]->ID; ?>&post_title=<?php echo $this->variables["current_object"]->post_title; ?>');

                }
            </script>
        
        <?php
    }

}