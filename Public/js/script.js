$("#filter").on('click', (e) => {
    let dateFrom = $("#dateFrom").val();
    let dateTo = $("#dateTo").val();
    // console.log(dateFrom , dateTo);
    let datesArray = [];
    for (date of $('.date')) {
        console.log(dateFrom, $(date).text().trim().split(' ')[0], dateTo);

        $(`#filter-${$(date).attr('data-id')}`).hide()
        $(date).parents('tr').hide();

        let selectedDate = $(date).text().trim().split(' ')[0];

        if (dateFrom <= selectedDate && selectedDate <= dateTo) {
            $(`#filter-${$(date).attr('data-id')}`).show()
            $(date).parents('tr').show();
        }
    }
})

filterUsers = () => {
    let id = $("option:selected").attr('data-id')
    $('.rows').hide();
    $(`#filter-${id}`).show();
}