var addDays = (date, days) => {
    const copy = new Date(Number(date))
    copy.setDate(date.getDate() + days)
    return copy
}

var lastDay = (y,m) => {
    return  new Date(y, m +1, 0).getDate();
}

export default {
    addDays,
    lastDay
}

