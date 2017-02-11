// Begin Custom

$(function () {
    $.datepicker.setDefaults({ beforeShow: function (i) { if ($(i).attr('readonly')) { return false; } } }); 
    $('.js-datepicker').datepicker(
            $.datepicker.regional[ "fr" ]
    );
    $('#accordion_consultation_parents').accordion({
        collapsible: true
    });
    
    bmi();
    $('.bmi_param').keyup(bmi);
    
    
    function bmi() {
        weight = $('#ps_consultationbundle_consultation_clinicExamConst_weight').val();
        height = $('#ps_consultationbundle_consultation_clinicExamConst_height').val() / 100;
        BMI = weight / (height * height);
        
        $('#BMIValue').text(BMI.toFixed(2));
    }
    
    
});

// End Custom

