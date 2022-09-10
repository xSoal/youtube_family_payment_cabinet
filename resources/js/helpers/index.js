
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



export  {
    showSuccess, showError
}
