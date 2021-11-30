/**
 * Convert currency into the floating number
 * @param {String} value
 */
function currencyToNumber(value)
{
    return parseFloat(value.substring(3).replace('&nbsp;', '').replace(/[^0-9\,\-]+/g, ''))
}
/**
 * Convert the floating number into currency
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