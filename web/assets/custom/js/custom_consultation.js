 $(function () {
    jQuery(document).ready(function() {
        $('body').on('submit', 'form', function (e) {

            e.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize()
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
        });
    });
 });