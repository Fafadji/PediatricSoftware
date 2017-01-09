// begin DataTable for listPatients
$(document).ready(function() {
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;
   
    var defaultNotVisibleColumns, defaultNotVisibleColumnsObject;
    defaultNotVisibleColumns= [];
    defaultNotVisibleColumnsObject = $('#listPatients thead .defaultNotVisColList')
    $( defaultNotVisibleColumnsObject ).each(function( index ) {
        defaultNotVisibleColumns.push(this.cellIndex);
    });
    
    
    var defaultVisibleColumns, defaultVisibleColumnsObject;
    defaultVisibleColumns= [];
    defaultVisibleColumnsObject = $('#listPatients thead .defaultVisColList')
    $( defaultVisibleColumnsObject ).each(function( index ) {
        defaultVisibleColumns.push(this.cellIndex);
    });
        
    tablePatient = $('#listPatients').DataTable({
            language: {
                'url': full_url
            },
            order: [[ 0, "asc" ]],
            columnDefs: [ { "orderable": false, "targets": [1, 2, 3] } ],
            colReorder: {
                fixedColumnsLeft: 4
            },
            "columnDefs": [
                {
                    "targets": defaultNotVisibleColumns,
                    "visible": false
                }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                    columns: ':not(thead .viewIcon, thead .editIcon, thead .deleteIcon, thead .IDPatient)',
                    text : 'Sélection Col.'
                },
                {
                    text: 'Conf. par défaut',
                    action: function ( e, dt, node, config ) {                   
                        tablePatient.state.clear();
                        window.location.reload();
                    }
                },
                {
                    extend: 'columnVisibility',
                    text: 'Toutes les col.',
                    visibility: true
                },
                {
                    extend: 'colvisGroup',
                    text: 'Col. par défaut',
                    hide: defaultNotVisibleColumns,
                    show: defaultVisibleColumns,
                    
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });

} );

// End DataTable for list patients







// begin DataTable for list mothers
$(document).ready(function() {
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;    
    
    
    var defaultNotVisCol, defaultNotVisColObj;
    defaultNotVisCol= [];
    defaultNotVisColObj = $('#listMothers thead .defaultNotVisColList')
    $( defaultNotVisColObj ).each(function( index ) {
        defaultNotVisCol.push(this.cellIndex);
    });
    
    tableMother = $('#listMothers').DataTable({
            language: {
                'url': full_url
            },
            order: [[ 0, "asc" ]],
            // columnDefs: [ { "orderable": false, "targets": [1, 2, 3] } ],
            //colReorder: {
            //    fixedColumnsLeft: 1
            //},
            "columnDefs": [
                {
                    "targets": defaultNotVisCol,
                    "visible": false
                }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    columns: ':not(thead .id)',
                    text : 'Sélection Col.',
                },
                {
                    extend: 'columnVisibility',
                    text: 'Toutes les col.',
                    visibility: true
                },
                {
                    extend: 'colvisGroup',
                    text: 'Col. par défaut',
                    show: '#listMothers thead .defaultVisColList',
                    hide: '#listMothers thead .defaultNotVisColList'
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });

} );

// End DataTable for list mothers







// Begin Wizard

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        
        //added to check validation
        var activeTab =  $(this).closest(".tab-pane"),
            curInputs = activeTab.find("input[type='text'],input[type='url'],input[type='radio']"),
            errorClass="alert alert-danger",
            isValid = true;

            
        $(".form-group").removeClass(errorClass);
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass(errorClass);
            }
        }

        if (isValid) {
            // original
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

// End Wizard
// Begin Custom

$(function () {
    selectExistingMotherForm();
    var createNewMotherCB = $('#ps_customerbundle_patient_createNewMotherCB');
    
    createNewMotherCB.click(function() {        
        if(createNewMotherCB.prop('checked') ) {
            createNewMotherForm();
        } else {
            selectExistingMotherForm();
        }

    });
     
    
    function selectExistingMotherForm() {    
        // enable select existing mother
        $('#fieldsetSEM').css('color','#333333').css('background','white');
        $('#fieldsetSEM legend').css('color','#333333');
        $('#fieldsetSEM select').attr('disabled',false);
        
        //disable create new mother form
        $('#fieldsetCNM').css('color','gray').css('background','#DCDCDC');
        $('#fieldsetCNM legend').css('color','gray');
        $('#fieldsetCNM input').prop('readonly',true);
        $('#fieldsetCNM select').attr('disabled',true);
    }
    
    function createNewMotherForm(){
        // disable select existing mother
        $('#fieldsetSEM').css('color','#gray').css('background','#DCDCDC');
        $('#fieldsetSEM legend').css('color','gray');
        $('#fieldsetSEM select').attr('disabled',true);
        
        //enable create new mother form
        $('#fieldsetCNM').css('color','#333333').css('background','white');
        $('#fieldsetCNM legend').css('color','#333333');
        $('#fieldsetCNM input').prop('readonly',false);
        $('#fieldsetCNM select').attr('disabled',false);
    }
    
});

// End Custom

