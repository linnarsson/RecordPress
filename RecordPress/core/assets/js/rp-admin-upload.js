/**
 *	Handles the upload function when adding or editing records.
 */
    //tb_show('', 'media-upload.php?TB_iframe=true');
    var upload_image_button=false;
    jQuery(document).ready(function() {

    jQuery('.upload_image_button').click(function() {
        upload_image_button =true;
        formfieldID=jQuery(this).prev().attr("id");
     formfield = jQuery("#"+formfieldID).attr('name');
     tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        if(upload_image_button==true){

                var oldFunc = window.send_to_editor;
                window.send_to_editor = function(html) {

                imgurl = jQuery('img', html).attr('src');
                jQuery("#"+formfieldID).val(imgurl);
                 tb_remove();
                window.send_to_editor = oldFunc;
                }
        }
        upload_image_button=false;
    });


    })


/**
 *	Handles the possibilities to add categories when adding or editing records. Found in rp-add-record.php and rp-edit-record.php.
 */
var counter = 0;

jQuery(document).ready(function($) {
//$('#submit_val').hide();
 $('p#rp-add-category-field').click(function(){

 counter += 1;

 $('#rp-add-category-container').append(

 '<strong>Category ' + counter + '</strong><br />'

 + '<input id="rp-add-category-field-' + counter + '" name="rp-add-category-fields[]' + '" type="text" /><br />' );

$('#submitcategory').show();

 });

});


/**
 *	Handles the possibilities to add formats when adding or editing records. Found in rp-add-record.php and rp-edit-record.php.
 */
var counter = 0;

jQuery(document).ready(function($) {

 $('p#rp-add-format-field').click(function(){

 counter += 1;

 $('#rp-add-format-container').append(

 '<strong>Format ' + counter + '</strong><br />'

 + '<input id="rp-add-format-field-' + counter + '" name="rp-add-format-fields[]' + '" type="text" /><br />' );

$('#submitformat').show();

 });

});

