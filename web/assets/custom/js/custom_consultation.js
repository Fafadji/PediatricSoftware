 $(function () {
    jQuery(document).ready(function() {
        
        function saveConsultation(form){
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize()
            })
            .done(function (data) {
                if (typeof data.message !== 'undefined') {
                    var form = $('form[name="ps_consultationbundle_consultation"]');
                    var consultation_id = data.consultation_id;
                    if(consultation_id != null) {
                        var currentUrl = form.attr('action') ;
                        
                        if (!currentUrl.match(/add_or_edit\/([0-9]+)\/([0-9]+)/)) {
                            var newurl = currentUrl + '/' + consultation_id;
                            form.attr('action', newurl);
                        }
                    }
                    
                    var field_id = fieldId("save");
                    $('#' + field_id  ).prop('disabled', true);
                    $('#' + field_id + ' select'  ).prop('disabled', true);
                    getClickedButton().prop('disabled', true);
                    
                    $.notify(data.message, "success");
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
     
                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.responseJSON.hasOwnProperty('form')) {
                        $('#form_body').html(jqXHR.responseJSON.form);
                    }

                    $('.form_error').html(jqXHR.responseJSON.message);

                } else {
                    alert(errorThrown);
                }

            });
        }
        
        function getClickedButton(){
            return $("button[type=submit][clicked=true]");
        }
        
        function editConsultField(form){
            var field_id = fieldId("edit");
            var edit_button = getClickedButton();
            var save_button_id = getClickedButton().attr('id').replace(/edit/g,'save')
            
            $('#'+field_id ).prop('disabled', false);
            $('#' + field_id + ' select'  ).prop('disabled', false);
            $('#'+save_button_id ).prop('disabled', false);
        }
        
        function fieldId(button_type) {
            var button_id = getClickedButton().attr('id');
            var textarea_field_prefix = 'ps_consultationbundle_consultation_';
            var field = button_id.substring(button_id.indexOf(button_type)+button_type.length);
            field = field.substr(0,1).toLowerCase()+field.substr(1);
            var textarea_field_id = textarea_field_prefix + field;
            
            return textarea_field_id;
        }
        
        $("form button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });
        
        $('body').on('submit', 'form', function (e) {
            e.preventDefault();
            
            var button_id = getClickedButton().attr('id');
            if (/save/i.test(button_id)) {
                saveConsultation(this);
            } else if (/edit/i.test(button_id)) {
                editConsultField(this);
            } 
            
       
            
        });
    });
 });