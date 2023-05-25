import { MD5 } from './md5.js'
import $ from 'jquery'

export function translate_baidu(translateText, query) {
    let appid = '20230517001681207';
    let key = 'qFGytXmDWDbrzZkTT7S6';
    let salt = (new Date).getTime();
    query = query.replace(/\n/g, "");
    query = query.split(". ");
    query = query.join(". \n");
    // console.log(query);
    let from = 'en';
    let to = 'zh';
    let str1 = appid + query + salt + key;
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
            if ('trans_result' in data) {
                let res = ''
                for (let i = 0; i < data['trans_result'].length; i++) {
                    res += data['trans_result'][i]['dst'];
                }
                // console.log(res)
                translateText.value = res;
            }
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

export function wikipedia(query, that) {
    let pageIds = ['', '', '']
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
            srlimit: '3',
            sroffset: '0'
        },
        success: function (data) {
            console.log(data['query']['search']);
            console.log(data['query']['search'].length);
            if (data['query']['search'].length > 2) {
                pageIds[0] = data['query']['search'][0]['pageid'];
                pageIds[1] = data['query']['search'][1]['pageid'];
                pageIds[2] = data['query']['search'][2]['pageid'];
                page_detail(pageIds, that);
            }
            else {
                that.showModal = true;
            }
            // let page_id = data['query']['search'][0]['pageid'];
            // page_detail(page_id);
        }
    });
}

export function page_detail(pageIds, that) {
    $.ajax({
        url: 'https://en.wikipedia.org/w/api.php',
        type: 'get',
        dataType: 'jsonp',
        data: {
            'action': 'query',
            'prop': 'description|extracts',
            'pageids': pageIds[0]+'|'+pageIds[1]+'|'+pageIds[2],
            'explaintext': '',
            'format': 'json'
        },
        success: function (data) {
            console.log(data['query']['pages']);
            that.titles[0] = data['query']['pages'][pageIds[0]]['title'];
            that.contents[0] = data['query']['pages'][pageIds[0]]['description'];
            that.titles[1] = data['query']['pages'][pageIds[1]]['title'];
            that.contents[1] = data['query']['pages'][pageIds[1]]['description'];
            that.titles[2] = data['query']['pages'][pageIds[2]]['title'];
            that.contents[2] = data['query']['pages'][pageIds[2]]['description'];
            let count = 0;
            for(let i = 0; i < 3; i++) {
                let appid = '20230517001681207';
                let key = 'qFGytXmDWDbrzZkTT7S6';
                let salt = (new Date).getTime();
                let query = that.contents[i];
                console.log(query);
                let from = 'en';
                let to = 'zh';
                let str1 = appid + query + salt + key;
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
                        count++;
                        console.log(data);
                        if ('trans_result' in data) {
                            let res = ''
                            for (let i = 0; i < data['trans_result'].length; i++) {
                                res += data['trans_result'][i]['dst'];
                            }
                            console.log(res)
                            that.contents[i] = res;
                        }
                        console.log(count);
                        if(count === 3){
                            that.showModal = true;
                        }
                    }
                });
            }
            // let str = data['query']['pages'][pageIds[0]]['extract'];
            // let index = str.indexOf('\n\n\n') + 1;
            // that.contents[0] = str.substring(0, index);
            // that.contents[0] = str.substring(0, );
            // that.showModal = true;
        }
    });
}