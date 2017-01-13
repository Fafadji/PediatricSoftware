// Begin Custom

$(function () {
    
    var activeTimer = 2000;
    var delayTimer = 1000;
    
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
    
    function addParentAnimation(listSel, creteSel, createCbSel) 
    {
        var listParentDom = $(listSel);
        var createParentDom = $(creteSel);
        var createNewParentCBDom = $(createCbSel);
        
        selectExistingParentForm();
        createNewParentCBDom.click(function() {        
            if(createNewParentCBDom.prop('checked') ) {
                createNewParentForm();
            } else {
                selectExistingParentForm();
            }

        });
        
        function selectExistingParentForm() {    
            createParentDom.hide(activeTimer);
            listParentDom.delay(delayTimer).show(activeTimer);
        }

        function createNewParentForm(){
            listParentDom.hide(activeTimer);
            createParentDom.delay(delayTimer).show(activeTimer);
        }
    }
    
});

// End Custom

