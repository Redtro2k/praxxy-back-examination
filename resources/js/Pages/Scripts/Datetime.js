const dateConverstion = (date) => String(date).padStart(2, '0') // date convertion to string

export default function GetDate(date){
    const dates = [];
    const times = []
    dates.push(date.getFullYear())
    dates.push(dateConverstion(date.getMonth() + 1));
    dates.push(dateConverstion(date.getDate()));
    times.push(dateConverstion(date.getHours()));
    times.push(dateConverstion(date.getMinutes()));
    times.push(dateConverstion(date.getSeconds()));
    return `${dates.join('-')} ${times.join(':')}`
} // date full details

