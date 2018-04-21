<script>
function openModalByUuid(id, mode)
{
    var modal = $('*[data-uuid="' + id +'"]');

    if (modal.length) {
        modal.modal('show');
    } else {
        $('#loading').show();

        $.get('/ajax/modal/' + id + '?mode=' + mode, function(res){
            var $div = $('body').append(res);
            modal = $('*[data-uuid="' + id +'"]');
            modal.modal('show');
            $('#loading').hide();
        });
    }
}
</script>
