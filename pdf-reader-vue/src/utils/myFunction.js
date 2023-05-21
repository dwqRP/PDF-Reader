import {MD5} from './md5.js'
import $ from 'jquery'

export function translate_baidu(translateText, query) {
    let appid = '20230510001673425';
    let key = 'aWqc5dLnLxTenq2I7cg5';
    let salt = (new Date).getTime();
    query = query.replace(/\n/g,"");
    query = query.split(". ");
    query = query.join(". \n");
    // console.log(query);
    let from = 'en';
    let to = 'zh';
    let str1 = appid + query + salt +key;
    let sign = MD5(str1);
    $.ajax({
        url: 'http://api.fanyi.baidu.com/api/trans/vip/translate',
        type: 'get',
        dataType: 'jsonp',
        data: {
            q: query,
            appid: appid,
            salt: salt,
            from: from,
            to: to,
            sign: sign
        },
        success: function (data) {
            console.log(data);
            let res = ''
            for(let i = 0; i < data['trans_result'].length; i++) {
                res += data['trans_result'][i]['dst'];
            }
            console.log(res)
            translateText.value = res;
        }
    });
}

export function wiki_baidu(query) {
    $.ajax({
        url: 'https://baike.baidu.com/api/openapi/BaikeLemmaCardApi',
        type: 'get',
        dataType: 'jsonp',
        data: {
            scope: '103',
            format: 'json',
            appid: '379020',
            bk_key: query,
            bk_length: '350'
        },
        success: function (data) {
            console.log(data);
        }
    });
}

export function wikipedia(query) {
    $.ajax({
        url: 'https://en.wikipedia.org/w/api.php',
        type: 'get',
        dataType: 'jsonp',
        data: {
            action: 'query',
            list: 'search',
            srsearch: query,
            utf8: '',
            format: 'json',
            srsort: 'relevance',
            srprop: 'wordcount',
            srlimit: '50',
            sroffset: '0'
        },
        success: function (data) {
            console.log(data['query']['search']);
            let page_id = data['query']['search'][0]['pageid'];
            page_detail(page_id);
        }
    });
}

export function page_detail(page_id) {
    $.ajax({
        url: 'https://en.wikipedia.org/w/api.php',
        type: 'get',
        dataType: 'jsonp',
        data: {
            'action': 'query',
            'prop': 'extract',
            'pageids': page_id,
            'explaintext': '',
            'format': 'json'
        },
        success: function (data) {
            console.log(data['query']['pages'][page_id]);
            console.log(data['query']['pages'][page_id]['extract']);
        }
    });
}