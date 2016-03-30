<?php $this->load->view("header"); ?> 

<div class="container">
    
    <div class="row">
        <div class="masonary-grids">
            <div id="loadContent">
            </div>
        </div>
    </div>
</div>
<?php //$this->load->view("slide_panel"); ?> 
</div>
<?php $this->load->view("footer"); ?>
<script>
    $.post('albums_featured/loadContent', function (data) {
        $('#loadContent').html(data);
    });//--end post
    
</script>