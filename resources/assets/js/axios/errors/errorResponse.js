
import { Notification } from 'element-ui';

export function errorResponse(error) {
    console.log(error.response)
    if (error.response.status === 422 ){
        var data = error.response.data;
        Object.values(data).map(function (key) {
            setTimeout(function () {
                Notification({
                    type:'error',
                    message:key[0]
                })
            },500)
        });
    }else{
        var msg = '啊哦～～ 遇到了一个错误,相应代码' + error.response.status +
                ' 错误信息:' + error.response.statusText;
        Notification({
            type:'error',
            message: msg
        })
    }

}