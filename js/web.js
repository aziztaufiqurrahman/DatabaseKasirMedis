$(document).ready(() => {
    var tbody = $('#cs-transactiontb').children('tbody')
    var table =  tbody.length? tbody : $('#cs-transactiontb')

    var ctx_name = $('#ctx_name')
    var ctx_count = $('#ctx_count')
    var ctx_content_count = $('#ctx_content_count')

    ctx_content_count.hide()
    ctx_count.val('1')

    ctx_name.on('input', function() {
        if (ctx_name.val().trim().length > 0) ctx_content_count.show()
        else
        {
            ctx_content_count.hide()
            ctx_count.val('1')
        }
    })

    $(document).on('input', 'input[name^="jumlah"]', function() {
        let col_count = $(this)
        let col_price = col_count.parent().next()
        let col_subtotal = col_price.next()

        let subtotal = col_count.val() * currencyToNumber(col_price.text())
        col_subtotal.text(numberToCurrency(subtotal))
        countTotal(table)
    })

    $('#add_product').click(function() {
        let name = ctx_name.val()
        let count = ctx_count.val()

        if (name.length == 0 || count.length == 0) return

        let id = 0
        let price = 1000
        table.append(generateRow(id, name, count, price))
        countTotal(table)
        
        ctx_name.val('')
        ctx_content_count.hide()
        ctx_count.val('1')
    })

    $(table).on('click', '.cs-btndelete', function() {
        $(this).closest('tr').remove()
        countTotal(table)
    })

    $('#clear_input').click(function() {
        ctx_name.val('')
        ctx_content_count.hide()
        ctx_count.val('1')
        $('#ctx_custname').val('')
        $('#ctx_custphone').val('')
        $('#ctx_custaddress').val('')
        $('#ctx_custpay').val('')
        $('#ctx_back').text(numberToCurrency(0))
    })

    $('#ctx_custpay').on('input', function() {
        let total = currencyToNumber($('#ctx_total').html())
        let payment = parseFloat($(this).val())
        let back = payment - total
        if (isNaN(back)) back = 0
        $('#ctx_back').text(numberToCurrency(back))
    })
})


function generateRow(id, name, count, price)
{
    let total = count * price
    return `<tr>
        <td></td>
        <td class="text-center"></td>
        <td class="text-left"><input type="hidden" name="id_product[]" id="id_product[]" value="${id}">${name}</td>
        <td class="text-center"><input type="number" class="cs-inputjumlah" name="jumlah[]" id="jumlah[]" value="${count}" min="1" max="100"></td>
        <td class="text-right">${numberToCurrency(price)}</td>
        <td class="text-right" id="subtotal">${numberToCurrency(total)}</td>
        <td class="text-center"><a class="cs-btndelete">Hapus</a></td>
    </tr>`
}

function currencyToNumber(value)
{
    return parseFloat(value.substring(3).replace('&nbsp;', '').replace(/[^0-9\,\-]+/g, ''))
}

function numberToCurrency(value)
{
    return value.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 2
    })
}

function countTotal(table)
{
    let rows = table.children('tr')
    let total = 0
    rows.each(function() {
        let subtotal = $(this).find('#subtotal').html()
        total += currencyToNumber(subtotal)
    })
    $('#ctx_total').text(numberToCurrency(total))
}