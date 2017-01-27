// Begin Custom

$(function () {
    $.datepicker.setDefaults({ beforeShow: function (i) { if ($(i).attr('readonly')) { return false; } } }); 
    $('#ps_consultationbundle_consultation_date').datepicker($.datepicker.regional[ "fr" ]);
    $('#accordion_consultation_parents').accordion({
      collapsible: true
    });
    
});

// End Custom

