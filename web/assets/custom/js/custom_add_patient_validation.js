$(function () {

    $("form[name=ps_customerbundle_patient]").areYouSure({'message':'Le patient n\'est pas sauvegardé!'} );

    $('.js-datepicker').change(function() {
      $( this ).valid();
    });

    //var errorClassCustom="alert alert-danger";
    $('form').validate({
        
        
        /*highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest(".form-group").addClass(errorClassCustom).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest(".form-group").addClass(validClass).removeClass(errorClassCustom);
        },*/
        
        errorPlacement: function(error, element) {
            if (element.attr("name") == "ps_customerbundle_patient[sex]") {
               error.insertAfter("#ps_customerbundle_patient_sex_label");
            } else {
               error.insertAfter(element);
            }
        },
        
    });
});