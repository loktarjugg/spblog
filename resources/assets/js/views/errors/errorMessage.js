
import { Message } from 'element-ui';

export function errorMessage(message = '操作失败') {

    Message({
        type: 'error',
        message: message
    });
}