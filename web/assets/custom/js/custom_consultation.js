 $(function () {
    
    $("form[name=ps_consultationbundle_consultation]").areYouSure({'message':'La consultation n\'est pas sauvegardée!'} );
    
    
    
    
    var patient_savePDH = $('#ps_consultationbundle_consultation_patient_savePersonalDiseasesHistory'),
        patient_saveFDH = $('#ps_consultationbundle_consultation_patient_saveFamilyDiseasesHistory'),
        patient_saveConsultation=$('#ps_consultationbundle_consultation_saveConsultation1'),
        patient_saveVaccines = $('#ps_consultationbundle_consultation_patient_saveVaccines')
    ;
    
     if( /consultation\/add_or_edit\/\d\/\d/i.test($(location).attr('href')) ) { 
         disableFields(patient_saveConsultation);
     }
     
    disableFields(patient_savePDH);
    disableFields(patient_saveFDH);
    disableFields(patient_saveVaccines);
    
    
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
        if(clicked_button.length) {
            if( /saveConsultation/i.test(clicked_button.attr('id')) ) {
                $("form textarea, form input").attr('readonly', true);
                $("form button[id *= 'save']").attr('disabled', true);
            } else {
               clicked_button.attr('disabled', true);
               clicked_button.parent().parent().find('textarea, input').attr('readonly', true);
            }
        }
    }

    function enableFields(clicked_button){
        if(clicked_button.length) {
            var clicked_button_id = clicked_button.attr('id');

            if( /editConsultation/i.test(clicked_button_id) ) {
                $("form textarea, form input").attr('readonly', false).change();
                $("form button").attr('disabled', false);
            } else {
                clicked_button.parent().find('button[name*=save]').attr('disabled', false);
                clicked_button.parent().parent().find('textarea, input').attr('readonly', false).change();
            }
        }
    }
    
    function getClickedButton(){
        return $("button[type=submit][clicked=true]");
    }
 });