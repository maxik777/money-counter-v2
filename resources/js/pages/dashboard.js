$(document).ready(function (){
    $("#name_id").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/dashboard/spends-names/'+$("#name_id").val(),
                type: 'GET',
                success:(function (data) {
                    response(data);
                }),
                error:(function (data){
                    console.log(data)

                })
            })
        },
    });

    $('.save').on('click', function (){
        var btn = $(this);
        $(btn).prop("disabled", true);
        $(btn).addClass('hidden');
        $('#loading').removeClass('hidden');
        hideDangerStyles();
        $.ajax({
            url: '/dashboard/save-spends',
            type: 'POST',
            data: $('form').serialize(),
            success:(function (data) {
                if (data.status == 200){
                    $(btn).prop("disabled", false);
                    $(btn).removeClass('hidden');
                    $('#loading').addClass('hidden');
                    $('form').trigger("reset");
                    getSpendsForCurrentMonth();
                    toastr.success('Data saved successfuly', '')
                }
            }),
            error:(function (data){
                if (data.responseJSON.errors.name && data.responseJSON.errors.name[0]){
                    toastr.error(data.responseJSON.errors.name[0], '')
                    $('input[name="name"]').addClass('border-red-500');
                    $('.name-label').addClass('text-red-500');
                }else {
                    toastr.error(data.responseJSON.errors.price[0], '')
                    $('input[name="price"]').addClass('border-red-500');
                    $('.price-label').addClass('text-red-500');
                }
                $(btn).prop("disabled", false);
                $(btn).removeClass('hidden');
                $('#loading').addClass('hidden');
            })
        })
    })

    getSpendsForCurrentMonth();

    function getSpendsForCurrentMonth()
    {
        $.ajax({
            url: '/dashboard/index',
            type: 'GET',
            dataType: "json",
        }).done(function (data) {
            if (data.status == 200){
                $('.current_spends').text(parseInt(data.current_spends).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}))
                $('.previous_spends').text(parseInt(data.previous_spends).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}))
            }

        });
    }

    function hideDangerStyles()
    {
        $('input[name="name"]').removeClass('border-red-500');
        $('.name-label').removeClass('text-red-500');
        $('input[name="price"]').removeClass('border-red-500');
        $('.price-label').removeClass('text-red-500');
    }
})
