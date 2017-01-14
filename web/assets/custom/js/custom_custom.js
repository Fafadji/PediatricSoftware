// Begin Custom

$(function () {
    
    var activeTimer = 2000;
    var delayTimer = 1000;
    
    $('#panel_create_mother label').first().append('<span class="appended"> * </span>');
    $('#panel_create_father label').first().append('<span class="appended"> * </span>');
    
    addParentAnimation(
        '#panel_list_mother',
        '#panel_create_mother',
        '#ps_customerbundle_patient_create_new_mother_cb'
    );
    
    addParentAnimation(
        '#panel_list_father',
        '#panel_create_father',
        '#ps_customerbundle_patient_create_new_father_cb'
    );
    
    function addParentAnimation(listSel, createSel, createCbSel) 
    {
        var listParentDom = $(listSel);
        var createParentDom = $(createSel);
        var createNewParentCBDom = $(createCbSel);
        var createParentNameInputDom = $(createSel + " input").first();
        
        showCorrectForm() ;
        createNewParentCBDom.click(function() {        
            showCorrectForm() ;
        });
        
        function showCorrectForm() {
             if(createNewParentCBDom.prop('checked') ) {
                createNewParentForm();
            } else {
                selectExistingParentForm();
            }
        }
        
        function selectExistingParentForm() {    
            createParentDom.hide(activeTimer);
            listParentDom.delay(delayTimer).show(activeTimer);
            createParentNameInputDom.removeAttr("required");
        }

        function createNewParentForm(){
            listParentDom.hide(activeTimer);
            createParentDom.delay(delayTimer).show(activeTimer);
            createParentNameInputDom.attr("required","required");
        }

    }
    
});

// End Custom

