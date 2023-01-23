$('document').ready(function () {
    $('.ingredient-enable').on('click', function () {
        let id = $(this).attr('data-id')
        let enabled = $(this).is(":checked")
        $('.ingredient-amount[data-id="' + id + '"]').attr('disabled', !enabled)
        $('.ingredient-amount[data-id="' + id + '"]').val(null)
        $('.ingredient-misura[data-id="' + id + '"]').attr('disabled', !enabled)
        $('.ingredient-misura[data-id="' + id + '"]').val(null)
    })
});
