 $(function () {
    jQuery(document).ready(function() {
        
        $("form button[type=submit]").click(function() {
            $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });
        
        $('body').on('submit', 'form', function (e) {
            e.preventDefault();
            
            var clicked_button = getClickedButton();
            var clicked_button_id = clicked_button.attr('id');
            
            if (/save/i.test(clicked_button_id)) {
                saveConsultation(this);
            } else if (/edit/i.test(clicked_button_id)) {
                editConsultField(this);
            } 
        });
        
        
        
        function saveConsultation(form){
            
            var clicked_button = getClickedButton();
            var field_id_next_to_button = getFieldIdNextToButton("save");
            
            jQuery.ajaxQueue({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize()
            })
            .done(function (data) {
                if (typeof data.message !== 'undefined') {
                    var consultation_id = data.consultation_id;
                    var form = $('form[name=ps_consultationbundle_consultation]');
                    if(consultation_id !== null) {
                        var currentUrl = form.attr('action') ;
                        
                        if (!currentUrl.match(/add_or_edit\/([0-9]+)\/([0-9]+)/)) {
                            var newurl = currentUrl + '/' + consultation_id;
                            form.attr('action', newurl);
                        }
                    }
                    
                    if( /saveConsultation/i.test(clicked_button.attr('id')) ) {
                        $("form textarea").prop('readonly', true);
                        $("form button[id *= 'save']").prop('disabled', true);
                    } else {
                        $('#' + field_id_next_to_button  ).prop('readonly', true);
                        // $('#' + field_id_next_to_button + ' select'  ).prop('readonly', true);
                        clicked_button.prop('disabled', true);
                    }

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
            var clicked_button_id = getClickedButton().attr('id');
            
            if( /editConsultation/i.test(clicked_button_id) ) {
                $("form textarea").prop('readonly', false);
                $("form button").prop('disabled', false);
            } else {
                var field_id_next_to_button = getFieldIdNextToButton("edit");
                var edit_button = getClickedButton();
                var save_button_id = getClickedButton().attr('id').replace(/edit/g,'save')

                $('#'+field_id_next_to_button ).prop('readonly', false);
                // $('#' + field_id_next_to_button + ' select'  ).prop('readonly', false);
                $('#'+save_button_id ).prop('disabled', false);
                $("form button[id *= 'saveConsultation']").prop('disabled', false);
            }
            

        }
        
        function getFieldIdNextToButton(button_type) {
            var clicked_button_id = getClickedButton().attr('id');
            var field_prefix = 'ps_consultationbundle_consultation_';
            var field = clicked_button_id.substring(clicked_button_id.indexOf(button_type)+button_type.length);
            field = field.substr(0,1).toLowerCase()+field.substr(1);
            var field_id = field_prefix + field;
            
            return field_id;
        }
        

    });
 });