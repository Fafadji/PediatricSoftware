 $(function () {
     
    disableFields($('#ps_consultationbundle_consultation_patient_savePersonalDiseasesHistory'));
    disableFields($('#ps_consultationbundle_consultation_patient_saveFamilyDiseasesHistory'));
    
    
    // set attribute "clicked" on a button when clicked. 
    // So that we can find later the button that have been clicked
    // remove the clicked attribute on all ather button first
    $("form[name=ps_consultationbundle_consultation] button[type=submit]").click(function() {
        $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });

    $('body').on('submit', 'form[name=ps_consultationbundle_consultation]', function (e) {
        e.preventDefault();

        var clicked_button = getClickedButton();
        var clicked_button_id = clicked_button.attr('id');

        if (/save/i.test(clicked_button_id)) {
            saveConsultation(clicked_button);
        } else if (/edit/i.test(clicked_button_id)) {
            enableFields(clicked_button);
        } 
    });


    function saveConsultation(clicked_button){

        // It's important to store the clicked button on a variable
        // because  we are doing actions on it after ajax call
        // if not stored and another button is selected, when the action on the clicked button is done
        // we migth be doing it on the last button clicked 
        // after the actual button on witch we want to perfom the action
        disableFields(clicked_button);
        var form = $('form[name=ps_consultationbundle_consultation]');

        jQuery.ajaxQueue({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: $(form).serialize()
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                
                var consultation_id = data.consultation_id;
                
                if(consultation_id !== 'undefined') {
                    var form = $('form[name=ps_consultationbundle_consultation]');
                    var currentUrl = form.attr('action') ;

                    if (!currentUrl.match(/add_or_edit\/([0-9]+)\/([0-9]+)/)) {
                        var newurl = currentUrl + '/' + consultation_id;
                        form.attr('action', newurl);
                    }
                }
                
                $.notify(data.message, "success");
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            enableFields(clicked_button);
            $.notify("Erreur dans la sauvegarde de la consultation. ", "error");
            $.notify("Consultation NON sauvegardé ", "error");

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
    
    function disableFields(clicked_button) {
        if( /saveConsultation/i.test(clicked_button.attr('id')) ) {
            $("form textarea, form input").attr('readonly', true);
            $("form button[id *= 'save']").attr('disabled', true);
        } else {
            var field_id_next_to_button = getFieldIdNextToButton(clicked_button);
            $('#' + field_id_next_to_button  ).attr('readonly', true);
            clicked_button.attr('disabled', true);
        }
    }

    function enableFields(clicked_button){
        var clicked_button_id = clicked_button.attr('id');

        if( /editConsultation/i.test(clicked_button_id) ) {
            $("form textarea").attr('readonly', false);
            $("form button").attr('disabled', false);
        } else {
            var field_id_next_to_button = getFieldIdNextToButton(clicked_button);
            var save_button_id = clicked_button_id.replace(/edit/g,'save')

            $('#'+field_id_next_to_button ).attr('readonly', false);
            $('#'+save_button_id ).attr('disabled', false);
            $("form button[id *= 'saveConsultation']").attr('disabled', false);
        }
    }
    
    function getClickedButton(){
        return $("button[type=submit][clicked=true]");
    }

    function getFieldIdNextToButton(button) {
        var button_id = button.attr('id');
        button_type='unknown';
        if( /save/i.test(button_id) ) {
            button_type='save';
        } else if( /edit/i.test(button_id) ) {
            button_type='edit';
        }
        
        var button_type_index = button_id.indexOf(button_type);
        
        var field_prefix = button_id.substring(0, button_type_index);
        var field = button_id.substring(button_type_index + button_type.length);
        field = field.substr(0,1).toLowerCase()+field.substr(1);
        var field_id = field_prefix + field;

        return field_id;
    }
 });