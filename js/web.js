/**
 * Konversi uang ke nomor pecahan
 * @param {String} value
 */
function currencyToNumber(value)
{
    return parseFloat(value.substring(3).replace('&nbsp;', '').replace(/[^0-9\,\-]+/g, ''))
}
/**
 * Konversi nomor pecahan ke uang (dalam bentuk rupiah)
 * @param {String} value
 */
function numberToCurrency(value)
{
    return value.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 2
    })
}