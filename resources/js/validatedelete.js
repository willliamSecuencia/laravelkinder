import Swal from 'sweetalert2';

window.deleteConfirm = function(formId,id)
{
    Swal.fire({
        icon: 'warning',
        text: '¡Esta seguro(a) de que desea eliminar el dato?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}


window.changeEstudianteEvaluacion = function(data)
{
    $.each(data, function( key, value ) {
        if(parseInt($("#estudianteevaluacion").val()) === parseInt(value.idestudiante)){
            $('#nivelestudiante').text(value.descripcion);
        }
    });
}


window.ocultarMenu = function(event)
{
    event.preventDefault();
    if ( $("#navmenu").css('display') == 'block' || $("#navmenu").css('display') == 'flex')
    {
        $("#navmenu").css("display", "none");
    }else{
        $("#navmenu").css("display", "block");
    }
}



