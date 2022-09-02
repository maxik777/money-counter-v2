
$(document).ready(function (){

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            dom: 'Blfrtip',
            ajax: "/report/list",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format("YYYY/MM/DD");
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ],
            buttons: [
                {
                    text: 'Report for previous month',
                    action: function ( e, dt, node, config ) {
                        const current = new Date();
                        current.setMonth(current.getMonth()-1);
                        const previousMonth = current.toLocaleString('default', { month: '2-digit' });
                        $.ajax({
                            url: "/report/list",
                            type: 'GET',
                            data:{
                                'month':previousMonth
                            },
                            dataType: 'json', // added data type
                            success: function(res) {
                                table.clear();
                                table.rows.add(res.data);
                                table.draw();
                                $('.leftover-items-price').text(parseInt(leftoverItemPricePrevious).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                leftoverItemPrice = leftoverItemPricePrevious;
                            }
                        });
                    }
                }
            ],
        });
        $('.dt-buttons').addClass('text-center');
        $('.dt-button').addClass('btn btn-primary');


        var selectedItemsPrice = 0.00
        var leftoverItemPrice = 0.00;
        var leftoverItemPricePrevious = 0.00;
        $.ajax({
            url: '/dashboard/index',
            type: 'GET',
            dataType: "json",
        }).done(function (data) {
            if (data.status == 200){
                leftoverItemPrice = data.current_spends;
                leftoverItemPricePrevious = data.previous_spends;
                $('.leftover-items-price').text(parseInt(leftoverItemPrice).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            }
        });

        $('.yajra-datatable tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
            var currentRow=$(this).closest("tr");
            var colSelectedItemPrice = currentRow.find("td:eq(1)").text(); // get current row 2nd TD
            if (currentRow.hasClass('selected')){
                selectedItemsPrice += parseInt(colSelectedItemPrice);
                leftoverItemPrice -= parseInt(colSelectedItemPrice)
            }else{
                selectedItemsPrice -= parseInt(colSelectedItemPrice);
                leftoverItemPrice += parseInt(colSelectedItemPrice);
            }
            $('.selected-items-wrapper').removeAttr('hidden');
            $('.selected-items-price').text(parseInt(selectedItemsPrice).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            $('.leftover-items-price').text(parseInt(leftoverItemPrice).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            if (selectedItemsPrice === 0){
                $('.selected-items-wrapper').attr("hidden",true);
            }
        });

        var rowId;
        $(document).on('click', '.edit-modal', function() {
            rowId = $(this).data('id');
            toggleModal('default-modal', true);
            $.ajax({
                url: '/report/item/'+rowId,
                type: 'GET',
                success:(function (data) {
                    if (data.status == 200){
                        $('input[name="name"]').val(data.name)
                        $('input[name="price"]').val(data.price)
                    }
                }),
                error:(function (data){
                    console.log(data)

                })
            })
        });

    $(document).on('click', '.delete-modal', function() {
        rowId = $(this).data('id');
        toggleModal('delete-modal', true);
    });

    $('.update').on('click', function (){
        var btn = $(this);
        $(btn).addClass('hidden');
        $('#loading').removeClass('hidden');
        var table = $('.yajra-datatable').DataTable();
        $.ajax({
            url: '/report/update/'+rowId,
            type: 'PUT',
            data: $('form').serialize(),
            success:(function (data) {
                if (data.status == 200){
                    toastr.success('Data updated successfuly', '')
                    toggleModal('default-modal', false);
                    table.ajax.reload(null, false );
                    hideDangerStylesReport();
                }
                $(btn).removeClass('hidden');
                $('#loading').addClass('hidden');
            }),
            error:(function (data){
                if (data.responseJSON.errors.name && data.responseJSON.errors.name[0]){
                    toastr.error(data.responseJSON.errors.name[0], '')
                    $('input[name="name"]').addClass('border-danger');
                    $('.name-label').addClass('text-red-500');
                }else {
                    toastr.error(data.responseJSON.errors.price[0], '')
                    $('input[name="price"]').addClass('border-danger');
                    $('.price-label').addClass('text-red-500');
                }
                $(btn).removeClass('hidden');
                $('#loading').addClass('hidden');
            })
        })
    })

    $('.delete').on('click', function (){
        var btn = $(this);
        $(btn).addClass('hidden');
        $('#loading').removeClass('hidden');
        var table = $('.yajra-datatable').DataTable();
        $.ajax({
            url: '/report/delete/'+rowId,
            type: 'DELETE',
            dataType: 'JSON',
            data:{
                'id': rowId,
                '_token':  $('meta[name="csrf-token"]').attr('content'),
            },
            success:(function (data) {
                if (data.status == 200){
                    toastr.success('Record deleted successfuly', '')
                    toggleModal('delete-modal', false);
                    table.ajax.reload(null, false );
                }
                $(btn).removeClass('hidden');
                $('#loading').addClass('hidden');
            }),
            error:(function (data){
                console.log(data)
                toastr.error('Oops, something went wrong', '')
                $(btn).removeClass('hidden');
                $('#loading').addClass('hidden');
            })
        })
    })

    $('.close').on('click', function (){
        toggleModal('default-modal', false);
        hideDangerStylesReport();
    })
    $('.decline').on('click', function (){
        toggleModal('default-modal', false);
        hideDangerStylesReport();
    })
    $('.close-modal').on('click', function (){
        toggleModal('delete-modal', false);
        hideDangerStylesReport();
    })
    $('.decline-modal').on('click', function (){
        toggleModal('delete-modal', false);
        hideDangerStylesReport();
    })

    function hideDangerStylesReport()
    {
        $('input[name="name"]').removeClass('border-danger');
        $('.name-label').removeClass('text-red-500');
        $('input[name="price"]').removeClass('border-danger');
        $('.price-label').removeClass('text-red-500');
    }

});




