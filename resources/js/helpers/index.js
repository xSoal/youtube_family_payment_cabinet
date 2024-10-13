
import {notification} from "ant-design-vue";

function showSuccess( message = 'Ок' ) {
    return notification['success']({
        message: message.toString()
    });
}


function showError( message ) {
    if(!message || message === '') message = 'Ошибка';
    return notification['error']({
        message: message.toString()
    });
}



function getDateYearMonth(){
    const dateObj = new Date();
    const month   = dateObj.getUTCMonth() + 1; 
    const day     = dateObj.getUTCDate();
    const year    = dateObj.getUTCFullYear();

    // const newDate = `${year}-${month}-${day}`;

    // 2023/1/7 to 2023/01/07
    const pMonth        = month.toString().padStart(2,"0");
    const pDay          = day.toString().padStart(2,"0");
    const newPaddedDate = `${year}-${pMonth}`;

    return newPaddedDate;
}



export  {
    showSuccess, showError, getDateYearMonth
}
