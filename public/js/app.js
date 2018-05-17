
var btnEdit = null ;

function showediteEtu(e) {
    btnEdit = $(e).val() ;
    $.get('etudiant/show',{
        idE:$(e).val()
    }).done(function (data) {
        var dataParsed = jQuery.parseJSON(data);
        $("#matEtEdit").val(dataParsed.mat);
        $("#idEtEdit").val(dataParsed.id);
        $("#nomEtEdit").val(dataParsed.nom);
        $("#prenomEtEdit").val(dataParsed.prenom);
        $("#classEtEdit").val(dataParsed.class);

    });
}
function updateEtut() {
    $.get('etudiant/update',{
       idE : $("#idEtEdit").val(),
        mateEtu : $("#matEtEdit").val(),
        nomE : $("#nomEtEdit").val(),
        prenomE :$("#prenomEtEdit").val(),
        classE: $("#classEtEdit").val()
    }).done(function (data) {
        if(data == 1)
        {
            $("#matetu"+btnEdit).html( $("#matEtEdit").val());
            $("#nometu"+btnEdit).html( $("#nomEtEdit").val());
            $("#prenometu"+btnEdit).html( $("#prenomEtEdit").val());
            $("#classetu"+btnEdit).html( $("#classEtEdit").val());
            $("#editEtut").modal('hide');
            btnEdit= null ;
            cleanEditEtu();
        }
        else {
            alert('eror internal code 500');
            console.log(data)
        }
    })
}
function addEtu(e) {
    $(e).attr('disabled','disabled');
    $.get('etudiant/create',{
        matE:$("#matEtAdd").val(),
        nomE:$("#nomEtAdd").val(),
        prenomE:$("#prenomEtAdd").val(),
        classE:$("#classEtAdd").val(),
    }).done(function (data) {
        if(data > 1)
        {
            var html = "<tr>\n" +
                "                        <td id=\"matetu"+data+"\"> "+$("#matEtAdd").val()+" </td>\n" +
                "                        <td id=\"nometu"+data+"\" > "+$("#nomEtAdd").val()+"</td>\n" +
                "                        <td id=\"prenometu"+data+"\" > "+$("#prenomEtAdd").val()+"</td>\n" +
                "                        <td id=\"classetu"+data+"\" > "+$("#classEtAdd").val()+"</td>\n" +
                "                        <td style=\"text-align: center\">\n" +
                "                            <button class=\"btn btn-primary\" value=\""+data+"\"\n" +
                "                                    onclick=\"showediteEtu(this)\"\n" +
                "                                    data-toggle=\"modal\" data-target=\"#editEtut\">\n" +
                "                                Editer\n" +
                "                            </button>\n" +
                "                            <button class=\"btn btn-warning\" value=\""+data+"\" onclick=\"DelEtu(this)\">\n" +
                "                                Suprimer\n" +
                "                            </button>\n" +
                "\n" +
                "                        </td>\n" +
                "                    </tr>"

            $("#tabEtu tbody").append(html);
            $("#addEtut").modal('hide');
            cleanAddEtu();
            $(e).removeAttr('disabled');
            alert('Ajout reussit avec success');
        }
        else
        {
            alert('eror internal code 500');
            console.log(data)
        }
    }).fail(function () {
        alert("Get connexion network")
        $(e).removeAttr('disabled');
    });


}

function DelEtu(e) {
confirm("Voulez vouz suprimer l'etudiant")
    {
        $.get('etudiant/delete',{
            idE : $(e).val()
        }).done(function (data) {
            if(data == 1)
            {
                $(e).parent().parent().remove();
            }
            else
            {
                alert('eror internal code 500');
                console.log(data);
            }
        });
    }
}

function addNote() {
   $.get('note/create',{
       valeur : $("#valNote").val(),
       semestre : $("#semNote").val(),
       annee : $("#anneNote").val(),
       matier : $("#matierNote").val(),
       idE : $("#idEtudiant").val(),
   }).done(function (data) {
       if(data== 1)
       {
           $("#addNote").modal('hide');
           cleanAddNote();
           alert('Note ajouter avec success');
       }
       else
       {
           alert('eror internal code 500');
           console.log(data);
       }
   })
}

function showAddNote(e) {
    $.get('etudiant/gets')
        .done(function (data) {
            console.log(data);
        var dataParsed = jQuery.parseJSON(data);
        var html= '';
        for(var i = 0 ; i < dataParsed.length ;i++)
        {
           html += '<option value=" '+dataParsed[i].id+' "> '+dataParsed[i].prenom +' '+dataParsed[i].nom+'</option>';
        }
        $("#idEtudiant").append(html);

    });
}
function showNoteEut(e) {
    $.get('note/shownoteetu',
        {
            idEt:$(e).val()
        })
        .done(function (data) {
        var dataParsed = jQuery.parseJSON(data);
        var html= '';
        for(var i = 0 ; i < dataParsed.length ;i++)
        {
           html += '<tr > ' +
               '<td class="noteEdit" item="valeur" idNote="'+dataParsed[i].id+'"><span>'+dataParsed[i].valeur+'</span> <input class="inputHide" type="hidden" step="0.01" value="'+dataParsed[i].valeur+'"></td>'+
               '<td class="noteEdit" item="matier" idNote="'+dataParsed[i].id+'"><span>'+dataParsed[i].matier+'</span> <input class="inputHide" type="hidden"  value="'+dataParsed[i].matier+'"></td>'+
               '<td class="noteEdit" item="semestre" idNote="'+dataParsed[i].id+'"><span>'+dataParsed[i].semestre+'</span> <input class="inputHide" type="hidden" step="0.01" value="'+dataParsed[i].semestre+'"></td>'+
               '<td class="noteEdit" item="annee" idNote="'+dataParsed[i].id+'"><span>'+dataParsed[i].annee+'</span> <input class="inputHide" type="hidden" step="0.01" value="'+dataParsed[i].annee+'"></td>'+
               '</tr>';
        }
        $("#TabNote tbody").append(html);

    });
}

function cleanAddEtu() {
    $("#matEtAdd").val('');
       $("#nomEtAdd").val('');
       $("#prenomEtAdd").val('');
        $("#classEtAdd").val('');
}
function cleanEditEtu() {
    $("#matEtEdit").val('');
    $("#idEtEdit").val('');
       $("#nomEtEdit").val('');
       $("#prenomEtEdit").val('');
        $("#classEtEdit").val('');
}
function cleanAddNote() {
    $("#valNote").val('');
    $("#anneNote").val('');
       $("#semNote").val('');
       $("#matierNote").val('');
        $("#idEtudiant").val('');
}


$(function () {
    $(document).on('dblclick','.noteEdit',function () {
        if($(this).attr('item')== 'valeur' || $(this).attr('item')== 'annee' || $(this).attr('item')== 'semestre')
        {
            $(this).children('input').attr('type','number');
        }
        else
        {
            $(this).children('input').attr('type','text');
        }
        $(this).children('span').hide();
        $(this).children('input').focus();

    });

    $(document).on('keypress','.noteEdit',function () {
        if(event.keyCode == 13)
        {
            $(this).children('input').attr('type','hidden');
            $(this).children('span').html($(this).children('input').val());
            $(this).children('span').show();
            $.get('note/updateSelect',{
                idNote:$(this).attr('idNote'),
                itemValue:$(this).children('input').val(),
                item : $(this).attr('item')
            }).done(function (data) {
                console.log(data);
                if(data == 1)
                {
                    console.log('ok')
                }
            });
        }
    });
    $('#showNote').on('hidden.bs.modal', function () {
        $("#TabNote tbody").html('');
    })
});