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
           /* language: {
                'url': full_url
            },*/
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
                    show: '.defaultVisColList',
                    hide: '.defaultNotVisColList'
                    
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });

} );

// End DataTable for list patients



// begin DataTable for list parent
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
    
    $('.list_parent').DataTable({
           /* language: {
                'url': full_url
            },*/
            order: [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": defaultNotVisCol,
                    "visible": false
                },
                { "orderDataType": "dom-checkbox", "targets": 0 }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    columns: ':not(thead .radioColumn)',
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
                    show: '.defaultVisColList',
                    hide: '.defaultNotVisColList'
                }
            ]
        });

} );

// End DataTable for list mothers
