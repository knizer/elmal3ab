<?php $this->load->view("header"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Drawing Tests</title>
        <link rel="stylesheet" type="text/css" href="<?= ASSETS; ?>fieldchooser/css/style.css" />

        <script src="<?= ASSETS; ?>fieldchooser/fieldChooser.js"></script>
        <script>
            $(document).ready(function () {
                var $sourceFields = $("#sourceFields");
                var $destinationFields = $("#destinationFields");
                var $chooser = $("#fieldChooser").fieldChooser(sourceFields, destinationFields);
            });
        </script>
    </head>
    <body>
        <div class="col-md-4">

            <div class="widget-area">
                <div class="inline-form">
                    <label class="c-label">ابحث هنا</label>
                    <input class="search_text"  type="text" placeholder="اكتب كلمة البحث" style="height: 30px;">
                </div>
                <input type="button" class="btn btn-success" value="بحث" id="click_search" class="btn btn-success margin-btn" style=" margin-top: 15px;">
            </div>
        </div>
        <div class="col-md-8" style="float: right;">
            <div class="widget-area">
                <div id="fieldChooser" tabIndex="1">
                    <div id="sourceFields">
                        <?php
                        foreach ($albums as $album) {

                           echo'<div id="from_' . $album->id . '"><p class="p-class">' . substr($album->title, 0, 200) . '</p> <div><p class="p-details">' . @$album->published_at . ' -';
                            if ($album->published == 1) {
                                echo "تم نشره" . "</p>";
                            } elseif ($album->published == 0)
                                echo "جديد" . "</p>";
                             if (isset($album->link))
                            echo '<a  data-toggle="modal" style="float:right"  href="#myModal_bulk" onclick="ViewArticle(' . $album->id . ',' . $album->published . ',\'' . $album->created_date . '\',\'' . str_replace('"', '', trim($album->title)) . '\')">عرض</a></div></div>';
                            else
                            echo '<a  data-toggle="modal" style="float:right"  href="#myModal_bulk" onclick="ViewArticle(' . $album->id . ',' . $album->published . ',\'' . $album->created_at . '\',\'' . str_replace('"', '', trim($album->title)) . '\')">عرض</a></div></div>';
                        }
                        ?>
                    </div>
                    <div id="destinationFields">
                        <?php
                        foreach ($list_data as $album) {

                             echo'<div id="to_' . $album->album_id . '"><p class="p-class">' . substr($album->title, 0, 200) . '</p><div><p class="p-details">' . @$album->created_at . ' - ';
                            if ($album->published == 1) {
                                echo "تم نشره" . "</p>";
                            } elseif ($album->published == 0)
                                echo "جديد" . "</p>";
                            echo '</div></div>';
                        }
                        ?>
                    </div>
                    <div class="col-md-62">
                        <div id="list_count"><?php echo "تحتوى" . count($list_data) . " من 6"; ?></div>
                    </div>
                    <div class="col-md-62" style="margin-top: 5px;">

                        <div id="footer_count"> عرض<?php echo $offset ?> لـ<?php echo $offset+5 ?> من إجمالى<?php echo $albums_count; ?> </div>
                        <div id="paging"> <?php echo $pagination; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="myModal_bulk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;top: 1%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">
                            <i class="fa fa-text-width" style="  margin: 0 11px 11px 11px;  font-size: 26px; float: right;"></i>
                            <p style="float: right; width: 10%; margin-top: 5px;">تفاصيل الخبر</p>
                            <div class="add_list" style="float: right;"></div>
                        </h4>
                        <div style="clear: both;"></div>
                    </div>

                    <div class="modal-body">
                        <div class="bulk_newsletter"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="float: right;clear: both;">
            <div class="widget-area">
                <div class="res" style=""><?php echo @$res; ?></div>
                <input type="button" class="btn btn-success margin-btn" value="حفظ التغييرات" id="save_changes">
            </div>
        </div>

    </body>

</html>
<script>

//--save changes button
    $("#save_changes").click(function () {
        $.post('<?php echo ROOT ?>albums_featured/saveChanges', {list_det: $('#destinationFields').html()}, function (data) {

            if (data == 1)
               window.location.href = "<?php echo ROOT.'albums_featured' ?>";
            else if (data == 2)
                $('.res').html("لديك أخبار مكررة من فضلك قم بحذفها وأعد المحاولة!");

            else
                $('.res').html(" لقد تجاوزت العدد المسموح به لكل قائمة وهو 6 عنصر فقط!");


        });//--end post


    });

    function deleteRecord(id) {
        // alert('"'+id+'"');
        $('#to_' + id).html("");
        $('#to_' + id).removeClass("fc-field fc-selected");
        $('#to_' + id).removeAttr('id');
    }//--end function

    function ViewArticle(id, status, date, title) {

        $('#myModal_bulk').modal('toggle');
        //$('#myModal_bulk').modal('show');
        $.post('<?php echo ROOT; ?>albums_featured/get_album', {album_id: id}, function (data) {


            $('.bulk_newsletter').html(data);
            $('.add_list').html(' <input type="button" class="btn btn-success btn-font" value="إضافة للقائمة" onclick="add_list(' + id + ',\'' + title + '\',' + status + ',\'' + date + '\')" style="margin-left: 80%;margin-top: -3%;">')

        });//--end post
    }//--end function

    function add_list(id, title, status, date) {
        var html1 = '<div id="from_' + id + '" class="fc-field" tabindex="1">' + title + '<br><div style="font-size: 13px;">' + date + ' - ';
        if (status == 2)
            html1 += 'تم نشره';
        else if (status == 3)
            html1 += 'جديد';
        html1 += '<a href="" onclick="deleteRecord(' + id + ')"><div style="color: blue;margin-right: 90%;margin-top: -6%;">حذف</div></a></div></div>';
        $('#from_' + id).html("");
        $('#from_' + id).removeClass("fc-field fc-selected");
        $('#from_' + id).removeAttr('id');

        html2 = $('#destinationFields').html();
        html = html1 + html2;
        $('#destinationFields').html(html);
        $('#myModal_bulk').modal('toggle');
    }

    $( "#click_search" ).click(function() {
        window.location.href = "<?php echo ROOT ?>albums_featured/search/"+$('.search_text').val();
});
</script>
