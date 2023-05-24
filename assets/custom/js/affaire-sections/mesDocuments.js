
const extensionIcons = [
    {
        extensions : ['jpeg','jpg','png','tiff','svg'],
        icon : 'fa fa-picture-o',
        color:'#08d99f'
    },
    {
        extensions : ['xlsx','xls','csv'],
        icon : 'fa fa-file-excel-o',
        color:'#6eff00'
    },
    {
        extensions : ['doc','docx'],
        icon : 'fa fa-file-word-o',
        color:'#089fd9'
    },
    {
        extensions : ['ppt','pptx'],
        icon : 'fa fa-file-powerpoint-o',
        color:'#d95f08'
    },
    {
        extensions : ['pdf'],
        icon : 'fa fa-file-pdf-o',
        color:'#d90825'
    },
    {
        extensions : ['txt','dat'],
        icon : 'fa fa-file-text-o',
        color:'#9bb2c5'
    },
    {
        extensions : ['zip','rar','tz','tar'],
        icon : 'fa fa-file-archive-o',
        color:'#fb7f50'
    }
]
var mesDocumentTable = $('#mesDocument-table').DataTable(
    {
        "processing": false,
        
        "ajax": {
            url: BaseUrl+'Affaire_missions/allMesAttach',
            type: "post",
            datatype:"json",
            
            error:function(XMLHttpRequest, textStatus, errorThrown)
            {
                //$('#taches-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','','','']).draw();
            
            }
        },
        "serverSide": false,
        "stateSave": true,
        responsive: true,
        "dom": 'Btip',
        "iDeferLoading": 20,
        "lengthMenu": [8,12],
        "pageLength": 12,
        "bSortClasses": false,
       columnDefs : [
        {
                render: function (data, type, row) {
                    let icon = 'fa fa-file-o';
                    let color = '#ababab';
                    if(type=="display"){
                       
                    extensionIcons.forEach(element => {
                        console.log(element.extensions)
                        if(element.extensions.includes(row[1])) 
                    {
                       
                        icon = element.icon;
                        color = element.color;
                        return;
                    }
                    });
                    return '<i class="'+icon+' fa-lg" style="color:'+color+';"></i>'
                    }
                    else return data;
                },
                targets:1,
            },
        {"targets": [0],"visible": false,"searchable": false}
        ],
        buttons: {
            dom: {
                button: {
                    className: "",
                },
            },
            buttons: [
                {
                    extend: "excelHtml5",
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: "btn btn-primary-outline",
                    filename: "Liste-mes-fichiers ",
                    title: "Liste de mes fichiers",
                    exportOptions: {
                        columns: ":not(.colAction)",
                    },
                },
            ],
        },
        "order": [[ 3, "desc" ]],
        "createdRow": function( row, data, dataIndex){
    
            if( data[12] == -1 ){
                $(row).addClass('tache-redRow');
            }
            if( data[12] == 1 ){
                $(row).addClass('tache-greenRow');
            }
            else if(data[15]=='f')
            {
                $(row).addClass('tache-blueRow');
            }
        },
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier&nbsp;&nbsp;",
                "sPrevious": "<",
                "sNext": ">",
                "sLast": "&nbsp;&nbsp;Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
    
        },
        
    });

    var shareDocumentTable = $('#shareDocument-table').DataTable(
    {
        "processing": false,
        
        "ajax": {
            url: BaseUrl+'Affaire_missions/filesShared',
            type: "post",
            datatype:"json",
            
            error:function(XMLHttpRequest, textStatus, errorThrown)
            {
                //$('#taches-table').DataTable().row.add(['<h5 style="color:red"><i class="fa fa-exclamation-triangle" style="font-size: 1.1em;margin-right:5px;"></i>Impossible de charger les données</h5>','','','','','','','','','','','','','','','']).draw();
            
            }
        },
        "serverSide": false,
        "stateSave": true,
        responsive: true,
        "dom": 'Btip',
        "iDeferLoading": 20,
        "lengthMenu": [8,12],
        "pageLength": 12,
        "bSortClasses": false,
        columnDefs : [
            {
                    render: function (data, type, row) {
                        let icon = 'fa fa-file-o';
                        let color = '#ababab';
                        if(type=="display"){
                           
                        extensionIcons.forEach(element => {
                           
                            if(element.extensions.includes(row[0])) 
                        {
                           
                            icon = element.icon;
                            color = element.color;
                            return;
                        }
                        });
                        return '<i class="'+icon+' fa-lg" style="color:'+color+';"></i>'
                        }
                        else return data;
                    },
                    targets:0,
                },
            
            ],
        buttons: {
            dom: {
                button: {
                    className: "",
                },
            },
            buttons: [
                {
                    extend: "excelHtml5",
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: "btn btn-primary-outline",
                    filename: "fichiers_partage ",
                    title: "Liste de fichiers partagés",
                    exportOptions: {
                        columns: ":not(.colAction)",
                    },
                },
            ],
        },
        "order": [[ 3, "desc" ]],
        "createdRow": function( row, data, dataIndex){
    
            if( data[12] == -1 ){
                $(row).addClass('tache-redRow');
            }
            if( data[12] == 1 ){
                $(row).addClass('tache-greenRow');
            }
            else if(data[15]=='f')
            {
                $(row).addClass('tache-blueRow');
            }
        },
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier&nbsp;&nbsp;",
                "sPrevious": "<",
                "sNext": ">",
                "sLast": "&nbsp;&nbsp;Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
    
        },
        
    });
    $('#mesDocument-table').on('click','.share-document',function(){
        let parent = $(this).closest('tr');
       
		var data = mesDocumentTable.row(parent).data();
		selectedTache = data[0];
        $('#share-dialog').attr('data-file',selectedTache)
        $('#share-dialog').modal('show');
    })
    /*autocomplete contrat suggestions*/

    $('#share-dialog').on('hidden.bs.modal', function () {
	
        $('#share-contact').val("");
        $(this).attr('data-file','0');
    });
    $( "#share-contact" ).autocomplete({
        source: function( request, response ) {
            
            var searchText = extractLast(request.term);
            $.ajax({
                url: BaseUrl+'Affaire_missions/suggestContact',
                type: 'post',
                dataType: "json",
                data: {
                    term: searchText
                },
                // success: function( data ) {
                //     response( data );
                // }
                success: function (data) {
				
                    response($.map(data, function (el) {
                     
                      return {
                                label: el.c_matricule+"("+el.nom+" "+el.prenom+")",
                                //label: el.c_matricule,
                                  value: el.matricule
                              };
                     }));
                   }
            });
        },focus: function() {                
            return false;
        },
        select: function( event, ui ) {
            var terms = split( $('#share-contact').val() );
            
            terms.pop();               

           if(duplicate($('#share-contact').val(), ui.item.label)){
            terms.push( ui.item.label );
            
            terms.push( "" );
            $('#share-contact').val(terms.join( "; " ));            
             }
            return false;
        }
       
    });


function split( val ) {
  return val.split( /;\s*/ );
}
function extractLast( term ) {
  return split( term ).pop();
}
function duplicate(f,s){
if( f.match(new RegExp("(?:^|,)"+s+"(?:,|$)"))) {
    return false;
}else{
   return true;
}
}

$('#share-btn').on('click',function(){
    if( $('#share-contact').val()!='')
    {
       
        var fileData = new FormData();
        
        fileData.append('contacts',$('#share-contact').val());
        fileData.append('file',$('#share-dialog').attr('data-file'));
        
        $.ajax({
    
            url : BaseUrl+'Affaire_missions/shareFile',
            type: 'POST',
            data : fileData,
            cache:false,
            processData:false,
            contentType:false,
            success: function(result){
                $('#share-dialog').modal('hide');
                showInfoBox('success','le fichier a bien été partagé');
            },
            error: function(err){
                showInfoBox('error',err.responseText);
                
    
            }
        })
    }
})
