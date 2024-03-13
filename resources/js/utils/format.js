export function currency(value) {
    return (new Intl.NumberFormat("ru", {style: "currency", currency: "RUB"}).format(value))
}

export function timeFormat(seconds) {
    return (new Date(seconds * 1000).toISOString().substr(11, 8))
}

export function toFixedUp(x, digits)  {
    const factor = 10 ** digits;
    return (Math.round(x * factor + 0.5) / factor).toFixed(digits);
}
