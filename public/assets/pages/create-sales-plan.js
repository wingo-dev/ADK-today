
window['moment-range'].extendMoment(moment);
$(document).ready(function() {

    var installmentsRowAction = '';

    $(".touchspin-icon").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        buttondown_txt: feather.icons["chevron-down"].toSvg(),
        buttonup_txt: feather.icons["chevron-up"].toSvg(),
        min: 1,
        max: 50,
    }).on("touchspin.on.stopupspin", function() {
        installmentsRowAction = "stopupspin";
    }).on("touchspin.on.stopdownspin", function() {
        installmentsRowAction = "stopdownspin";
    }).on("touchspin.on.stopspin", function() {
        var t = $(this);
        if (installmentsRowAction == "stopupspin") {
            addInstallmentsRows(t.val());
        } else if (installmentsRowAction == "stopdownspin") {
            addInstallmentsRows(t.val());
        }

        populateInstallmentTableRows(installmentsRowAction);
        installmentsRowAction = '';
    }).on("change", function() {
        var t = $(this);
        $(".bootstrap-touchspin-up, .bootstrap-touchspin-down").removeClass("disabled-max-min");
        1 == t.val() && $(this).siblings().find(".bootstrap-touchspin-down").addClass(
            "disabled-max-min");
        50 == t.val() && $(this).siblings().find(".bootstrap-touchspin-up").addClass(
            "disabled-max-min")
    });

    $('.installment_type_radio').on('change', function() {
        var ele = $(this);

        switch (ele.val()) {
            case 'quarterly':
                $('#how_many').text('Quaters');
                break;

            case 'monthly':
                $('#how_many').text('Months');
                break;

            default:
                break;
        }
        populateInstallmentTableRows();
    });

    $(".flatpickr-basic").flatpickr({
        defaultDate: "today",
        minDate: "today",
    });


    $('#unit_price').on('change', function() {
        let unit_price = parseFloat($(this).val());
        let unit_size = parseFloat($('#unit_size').val());

        let unit_price_total = parseFloat(unit_price * unit_size);
        $('#unit_price_total').val(unit_price_total).trigger('change');
    });

    $('#unit_price_total').on('change', function() {
        $('.additional-cost-checkbox').trigger('change');
    });

    $('.additional-cost-checkbox').on('change', function() {
        let elementId = $(this).attr('id');
        elementId = elementId.slice(('checkbox-').length);

        let divElement = $(`#div-${elementId}`);
        let percentageElement = $(`#percentage-${elementId}`);
        let totalPriceElement = $(`#total-price-${elementId}`);

        let percentage = parseFloat(percentageElement.val());
        let totalPrice = parseFloat(totalPriceElement.val());

        console.log(percentage, totalPrice);



        if ($(this).is(':checked')) {
            divElement.show().childern(totalPriceElement).val(0);
        } else {
            divElement.hide().childern(totalPriceElement).val(0);
        }






        // let additional_cost = parseFloat($(this).val());
        // let unit_price_total = parseFloat($('#unit_price_total').val());
        // let total = parseFloat(unit_price_total + additional_cost);
        // $('#total').val(total).trigger('change');
    });

});

// function applyAdditionalCost(key, slug, percentage) {

//     var unit_price_total = parseInt($('#unit_price_total').val());

//     if ($('#additionalCostCheckbox_' + key).is(':checked')) {
//         var additionalCost = parseInt(unit_price_total * percentage / 100);
//         $('#' + slug + '_total_' + key).val(additionalCost);
//         $('#div_additional_cost_' + key).show();
//     } else {
//         $('#div_additional_cost_' + key).hide();
//         $('#' + slug + '_total_' + key).val(0);
//     }


// }

function addInstallmentsRows(num) {
    if (num > 0) {
        var row = "";
        for (let index = 1; index < num; index++) {
            row += `
            <tr id="row_${index}">
                <th scope="row">${index + 1}</th>
                <td>
                    <div class="">
                        <input type="text" id="installment_date_${index}"
                            name="installments[installments][${index}][date]"
                            class="form-control" readonly placeholder="YYYY-MM-DD" />
                    </div>
                </td>
                <td>
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-lg"
                            id="installment_detail_${index}" name="installments[installments][${index}][details]"
                            placeholder="Details" />
                    </div>
                </td>
                <td>
                    <div class="position-relative">
                        <input type="number" class="form-control form-control-lg"
                            id="installment_amount_${index}" name="installments[installments][${index}][amount]"
                            placeholder="Amount" />
                    </div>
                </td>
                <td>
                    <div class="position-relative">
                        <input type="text" class="form-control form-control-lg"
                            id="installment_remark_${index}" name="installments[installments][${index}][remarks]"
                            placeholder="Remarks" />
                    </div>
                </td>
            </tr>`;
        }


        $('#installments_table #dynamic_installment_rows').html(row);
    }
}

function installmentsRemoveRow() {
    $('#installments_table #dynamic_installment_rows tr:last').remove();
}

function DateRanges(startDate, length = 1, monthsCount = 1, rangeBy = 'months') {

    let endDate = moment(startDate).add(((length - 1) * monthsCount), rangeBy);

    let range = moment.range(startDate, endDate);
    let years = Array.from(range.by(rangeBy, {
        step: monthsCount
    }));

    let datesArray = years.map(m => m.format('YYYY-MM-DD'));
    // datesArray.shift();
    return datesArray;
}

function populateInstallmentTableRows(action = '') {

    showBlockUI('#installments_acard');

    // startDate: $("#installment_date_0").val(),
    let data = {
        startDate: '2021-12-15',
        length: parseInt($(".touchspin-icon").val()),
        daysCount: $(".custom-option-item-check:checked").val() == 'quarterly' ? 90 : 30,
        rangeBy: 'days',
    };

    // $.ajax({
    //     url: '{{ route('sites.floors.units.sales-plans.ajax-generate-installments', ['site_id' => encryptParams($site->id), 'floor_id' => encryptParams($floor->id), 'unit_id' => encryptParams($unit->id)]) }}',
    //     type: 'GET',
    //     data: data,
    //     success: function(response) {
    //         if (response.status) {
    //             console.log(response);
    //             hideBlockUI('#installments_acard');
    //         }
    //     },
    //     error: function(errors) {
    //         hideBlockUI('#installments_acard');
    //     }
    // });
}

// console.log(DateRanges('2021-12-15', 10, 30, 'days'));
