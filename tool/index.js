const puppeteer = require('puppeteer');
var cheerio = require('cheerio');
fs = require('fs');
const pages = {};
const opts = {
    errorEventName:'error',
    logDirectory:__dirname+'/logs', // NOTE: folder must exist and be writable...
    fileNamePattern:'roll-<DATE>.log',
    dateFormat:'YYYY.MM.DD'
};
const log = require('simple-node-logger').createRollingFileLogger( opts );
const mysql = require('mysql');

var pool  = mysql.createPool({
    host    : 'localhost',
    user    : 'betogaizin',
    password: '5m3EpXhex9HuAKBS',
    database: 'cms',
});

var moment = require('moment');

console.log("\nRUN == Time:"+moment().format("YYYY-MM-DD HH:mm:ss")+"\n");
let timeEnd1 = moment().add('-30','minutes').format("YYYY-MM-DD hh:mm:ss");
console.log(timeEnd1);

let timeEnd = moment().add('-'+(60*24*0.5),'minutes').format("YYYY-MM-DD HH:mm:ss");



async function YAMATO(tracking){
    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];
        console.log('http://track.kuronekoyamato.co.jp/english/tracking');
        console.log(tracking);
        await page.goto('http://track.kuronekoyamato.co.jp/english/tracking', { waitUntil: 'networkidle2' });
        await page.waitForSelector('#main');
        for(let index in tracking){
            let _index = parseInt(index)+1;
            await page.$eval('input[name="number'+((_index)<10?'0'+_index:_index)+'"]', (el,val) => el.value = val,tracking[index].id);
        }

        await page.click('input[name="sch"]');
        await page.waitForSelector('#main',3000);

        setTimeout(async function () {

            const inner_html = await page.evaluate(() => document.querySelector('body').innerHTML);

            let $ = cheerio.load(inner_html);

            let Trackings = {};
            $("form table").each(function () {
                if($(this).attr('width') !== "no"){
                    $(this).find('tr').each(function () {
                        let _tr = $(this);
                        let td = _tr.find('td');
                        let id = $(td[2]).text().trim().replace(/\s+/g, " ");
                        if(id){
                            let key = id.replace(/-+/g, "");
                            Trackings[key] = {
                                Id : id,
                                Date : $(td[3]).text().trim().replace(/\s+/g, " "),
                                Text : $(td[4]).text().trim().replace(/\s+/g, " "),
                            };
                            Trackings[key].Status = 3;
                            if(Trackings[key].Text.indexOf("Delivered") >=0){
                                Trackings[key].Status = 1;
                            }else if(Trackings[key].Text.indexOf("Incorrect") >=0){
                                Trackings[key].Status = 10;
                            }
                        }
                    });
                }
            });
            $("center table").each(function () {
               // console.log($(this).html());
            });
            resolve([Trackings,tracking]);
        },3000);
    });
}
async function SAGAWA(tracking){
    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];
        console.log('http://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp');
        console.log(tracking);
        await page.goto('http://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp', {waitUntil: 'networkidle2'});
        await page.waitForSelector('#main');

        for(let index in tracking){
            let _index = parseInt(index)+1;
            await page.$eval('input[name="main:no'+(_index)+'"]', (el,val) => el.value = val,tracking[index].id);
        }

       await page.click('input[name="main:toiStart"]');
        setTimeout(async function () {
            const inner_html = await page.evaluate(() => document.querySelector('body').innerHTML);
            fs.writeFile(__dirname+'/logs/SAGAWA.html', inner_html, function (err) {
                if (err) return console.log(err);
                console.log('SAGAWA.html');
            });
            let $ = cheerio.load(inner_html);
            let Trackings = {};

            $("form table.ichiran-bg-esrc").each(function () {

                $(this).find('tr').each(function () {
                    let _tr = $(this);
                    let td = _tr.find('td');
                    let id = $(td[0]).find('input').val();

                    if(id){
                        id = id.trim().replace(/\n/g, ' ');
                        let key = id.replace(/-+/g, "");
                        Trackings[key] = {
                            Id : id,
                            Date : $(td[1]).text().trim().replace(/\s+/g, ""),
                            Text : $(td[2]).text().trim().replace(/\s+/g, " "),
                        };
                        Trackings[key].Status = 3;
                        if(Trackings[key].Text.indexOf('Delivered')>=0){
                            Trackings[key].Status = 1;
                        }else if(Trackings[key].Text.indexOf('Incorrect')>=0){
                            Trackings[key].Status = 10;
                        }
                    }
                });
            });

            resolve([Trackings,tracking]);
        },3000);
    });
}
async function JAPAN_POST(tracking){

    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];
        console.log('https://trackings.post.japanpost.jp/services/srv/search/input');
        console.log(tracking);
        await page.goto('https://trackings.post.japanpost.jp/services/srv/search/input', {waitUntil: 'networkidle2'});
        await page.waitForSelector('#content');
        let _index = 1;
        for(let index in tracking){
            _index = parseInt(index)+1;
          console.log(tracking[index].id);
            await page.$eval('input[name="requestNo'+(_index)+'"]', (el,val) => el.value = val,tracking[index].id);
        }
        if(_index == 1)
            await page.$eval('input[name="requestNo'+(_index+1)+'"]', (el,val) => el.value = val,new Date().getTime());
        await page.click('input[name="search"]');
        await page.waitForSelector('#content');
        setTimeout(async function () {
            const inner_html = await page.evaluate(() => document.querySelector('body').innerHTML);
            fs.writeFile(__dirname+'/logs/JAPAN_POST.html', inner_html, function (err) {
                if (err) return console.log(err);
                console.log('SAGAWA.html');
            });
            let $ = cheerio.load(inner_html);
            let Trackings = {};
            $("#content form table").each(function () {
                let last = "";
                $(this).find('tr').each(function () {
                    let _tr = $(this);
                    let td = _tr.find('td');
                    if(td.length > 0){
                        let input = $(td[0]).find('a');
                        if(input.length > 0){
                            if(td.length === 6){
                                let id = input.text();
                                last = id;
                                if(id){
                                    id = id.trim().replace(/\n/g, ' ').replace(/\s+/g, " ");
                                    let key = id.replace(/-/g, "");
                                    Trackings[key] = {
                                        Id : id ,
                                        Date : $(td[2]).text().trim().replace(/\s+/g, " "),
                                        Text : $(td[3]).text().trim().replace(/\s+/g, " "),
                                    };
                                    Trackings[key].Status = 3;
                                    if(Trackings[key].Text.indexOf("お届け先にお届け済み")>=0){
                                        Trackings[key].Status = 1;
                                    }else if(Trackings[key].Text.indexOf('Incorrect')>=0){
                                        Trackings[key].Status = 10;
                                    }
                                }
                            }
                        }else{
                            let id = $(td[0]).text();
                            id = id.trim().replace(/\n/g, ' ').replace(/\s+/g, " ");
                            let key = id.replace(/-/g, "");
                            Trackings[key] = {
                                Id : id ,
                                Date : "",
                                Text : $(td[1]).text(),
                            };
                            Trackings[key].Status = 10;
                        }
                    }
                });
            });
            resolve([Trackings,tracking]);
        },3000);
    });
}

(async () => {
    const browser = await puppeteer.launch({ headless: true ,args:['--no-sandbox','--disable-setuid-sandbox']});
    const [tabOne] = (await browser.pages());
    pages["YAMATO"] = tabOne;

   // pages["YAMATO"].setViewport({ width: 1280, height:720 });

    // pages["SAGAWA"] =  await browser.newPage();
    // pages["SAGAWA"].setViewport({ width: 1280, height:720 });
    //
    // pages["JAPAN_POST"] =  await browser.newPage();
    // pages["JAPAN_POST"].setViewport({ width: 1280, height:720 });
    let configs = {
        YAMATO : {
            url:"http://track.kuronekoyamato.co.jp/english/tracking",
            config:{ waitUntil: 'networkidle2' }
        },
        SAGAWA : {
            url:"http://track.kuronekoyamato.co.jp/english/tracking",
            config:{ waitUntil: 'networkidle2' }
        },
        JAPAN_POST : {
            url:"http://track.kuronekoyamato.co.jp/english/tracking",
            config:{ waitUntil: 'networkidle2' }
        }
    };
    let pushData = [];
    let databaseData = {};
    let databaseLock = {


    };
    // let tYAMATO = setInterval(function () {
    //     pushData.push({name:"YAMATO",data:[380180590484,380179697192]});
    // },5000);
    // pushData.push({name:"SAGAWA",data:['4028-5282-4301','4025-1635-6745']});
    // let tSAGAWA = setInterval(function () {
    //     pushData.push({name:"SAGAWA",data:['4028-5282-4301','4025-1635-6745']});
    // },15000);
    // let tJAPAN_POST = setInterval(function () {
    //     pushData.push({name:"JAPAN_POST",data:['156482236175','156480922640']});
    // },25000);
    let lock = false;
    function GetData(Cb){
        var conn = mysql.createConnection({
            host    : 'localhost',
            user    : 'betogaizin',
            password: '5m3EpXhex9HuAKBS',
            database: 'cms',
        });
        conn.connect(function (err){
            if (err) throw err.stack;

            let timeEnd = moment().add('-'+(60*24*0.5),'minutes').format("YYYY-MM-DD HH:mm:ss");

            // var sql = "SELECT * FROM `cms_shop_order_excel_tracking` where status != 1 and status < 10 and count<10 and (updated_at <= '"+timeEnd+"' or status=0) order by updated_at LIMIT 0,20";
            var sql = "SELECT * FROM `cms_shop_order_excel_tracking` where tracking_id != 'CXL' and tracking_id !='キャンセル' and status != 1 and status<10 and (status=0 or updated_at <= '"+timeEnd+"' or status = 3 and process ='1' and updated_at >= '"+moment().format("YYYY-MM-DD")+" 00:00:00' and updated_at <= '"+moment().format("YYYY-MM-DD")+" 23:59:59') order by updated_at LIMIT 0,200";
            console.log("SQL 1 : "+sql);
            let rows = {};
            let _databaseData = {};
            conn.query(sql, function (err,results, fields) {
                if (err) throw err;
                let count =0;

                for(let key in results){
                    let trangid = results[key].tracking_id;
                    if(trangid.toString().length === 0){
                        continue;
                    }
                    if(trangid.toString() === "CXL"){
                        continue;
                    }
                    if(trangid.toString() === "キャンセル"){
                        continue;
                    }
                    if(!_databaseData.hasOwnProperty(results[key].type)){
                        _databaseData[results[key].type] = {};
                    }
                    _databaseData[results[key].type][results[key].tracking_id] = results[key];
                    count++;
                }


                let a;
                let hour = parseInt(moment().hour().toString());
                // console.log('Data:'+count + " hour:"+hour);
                if(count < 20 && ( hour === 19 || hour === 10 || hour === 12 || hour === 15 || hour === 17)){

                    a = new Promise(function (resolve, reject) {

                        timeEnd1 = moment().add('-'+(60),'minutes').format("YYYY-MM-DD HH:mm:ss");
                        let sql1 = "SELECT * FROM `cms_shop_order_excel_tracking` where tracking_id != 'CXL' and tracking_id !='キャンセル' and status = 3 and  updated_at <= '"+timeEnd1+"' order by updated_at LIMIT 0,100";

                        // console.log("SQL 2 : "+sql1);

                        conn.query(sql1, function (err,results, fields) {
                            if (err){
                                resolve();
                            }else{
                                let count = 0;
                                let ___databaseData = {};
                                for(let key in results){
                                    let trangid = results[key].tracking_id;
                                    if(trangid.toString().length === 0){
                                        continue;
                                    }
                                    if(trangid.toString() === "CXL"){
                                        continue;
                                    }
                                    if(trangid.toString() === "キャンセル"){
                                        continue;
                                    }

                                    if(!___databaseData.hasOwnProperty(results[key].type)){
                                        ___databaseData[results[key].type] = {};
                                    }
                                    if(!___databaseData[results[key].type].hasOwnProperty(results[key].tracking_id)){
                                        ___databaseData[results[key].type][results[key].tracking_id] = results[key];
                                    }
                                    count++;
                                }
                                // console.log('Data 2:'+count + " hour:"+hour);
                                resolve([___databaseData,_databaseData]);
                            }
                        })
                    });
                }else{
                    a = new Promise(function (resolve, reject) {
                        resolve([_databaseData]);
                    });
                }
                a.then(function (t) {

                    databaseData = {};

                    for(let i =0; i < t.length ; i++){

                        for(let name in t[i]){
                            if(!databaseData.hasOwnProperty(name)){
                                databaseData[name] = {};
                            }
                            for(let index in t[i][name]){
                                if(!databaseData[name].hasOwnProperty(t[i][name][index].tracking_id)){
                                    databaseData[name][t[i][name][index].tracking_id] = t[i][name][index];
                                }
                            }
                        }
                    }

                    for(let name in databaseData){
                        for(let index in databaseData[name]){
                            conn.query('UPDATE `cms_shop_order_excel_tracking` SET count='+(databaseData[name][index].count+1)+', process = "1",`updated_at`=now() WHERE `id` = '+databaseData[name][index].id+';')
                        }
                    }
                    databaseLock = {};
                    lock = false;
                    conn.end();
                    Cb();
                }).catch(function (t) {

                    for(let i =0; i < t.length ; i++){

                        for(let name in t[i]){
                            if(!databaseData.hasOwnProperty(name)){
                                databaseData[name] = {};
                            }
                            for(let index in t[i][name]){
                                if(!databaseData[name].hasOwnProperty(t[i][name][index].tracking_id)){
                                    databaseData[name][t[i][name][index].tracking_id] = t[i][name][index];
                                }
                            }
                        }
                    }
                    for(let name in databaseData){
                        for(let index in databaseData[name]){
                            conn.query('UPDATE `cms_shop_order_excel_tracking` SET count='+(databaseData[name][index].count+1)+',process="1",`updated_at`=now() WHERE `id` = '+databaseData[name][index].id+';')
                        }
                    }
                    databaseLock = {};
                    lock = false;
                    conn.end();
                    Cb();
                });
            });
        });
    }
    function AddQueue(name){

        try{
            let countEmpty = 0;

            for(let name in databaseData){
                let trackingIds = [];
                let count = 0;

                for(let index in databaseData[name]){
                    if(!databaseLock.hasOwnProperty(index)){
                        databaseLock[index] = new Date();

                        trackingIds.push({
                            id:index,
                            key:index.replace(/-+/g, ""),
                            data:databaseData[name][index],
                        });
                        count++;
                        if(count > 0){
                            break;
                        }
                    }
                }
                if(trackingIds.length > 0){
                    pushData.push({name:name,data:trackingIds});
                }
            }

            console.log(name+' AddQueue:'+pushData.length+" "+moment().format("YYYY-MM-DD HH:mm:ss"));

            if(pushData.length === 0){
                GetData(function () {

                });
            }
        }catch (e) {

        }
    }

    GetData(function () {
        AddQueue('Init');
    });

    setInterval(function () {
        if(lock === false){
            AddQueue('setInterval');
        }
    },10000);
    let countLock = 0;
    setInterval(function () {
        if(lock === false ){
            countLock = 0;
            if(pushData.length > 0){
                lock = true;
                let data = pushData.shift();

                if(data.hasOwnProperty('name') && configs.hasOwnProperty(data.name)){

                    if(data.name === "YAMATO"){

                        YAMATO(data.data).then(function (vals) {
                            lock = false;

                            log.info('YAMATO:'+JSON.stringify(vals));
                            for(let i in vals[1]){

                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;
                                    if(vals[0][vals[1][i].key].Status){
                                         sql = "UPDATE `cms_shop_order_excel_tracking` SET `process` = "+vals[0][vals[1][i].key].Status+",`status` = "+vals[0][vals[1][i].key].Status+",`data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `process` = "+vals[0][vals[1][i].key].Status+",`status` = "+vals[0][vals[1][i].key].Status+",`data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }
                                    pool.query(sql,function () {

                                    });
                                }
                            }
                        }).catch(function () {
                            lock = false;
                        });
                    }else if(data.name === "SAGAWA"){
                        SAGAWA(data.data).then(function (vals) {
                            lock = false;

                            log.info('SAGAWA:'+ JSON.stringify(vals));

                            for(let i in vals[1]){
                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;
                                    if(vals[0][vals[1][i].key].Status){
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET `process`="+vals[0][vals[1][i].key].Status+" , `status` = "+vals[0][vals[1][i].key].Status+" , `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `process`="+vals[0][vals[1][i].key].Status+",`status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }

                                    pool.query(sql,function () {

                                    });
                                }

                            }
                        }).catch(function () {
                            lock = false;
                        });
                    }else if(data.name === "JAPAN_POST"){
                        JAPAN_POST(data.data).then(function (vals) {
                            lock = false;
                            log.info('JAPAN_POST:'+JSON.stringify(vals));
                            for(let i in vals[1]){
                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;
                                    if(vals[0][vals[1][i].key].Status){
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET `process`="+vals[0][vals[1][i].key].Status+" , `status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `process` = "+vals[0][vals[1][i].key].Status+" , `status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }

                                    pool.query(sql,function () {

                                    });
                                }

                            }
                        }).catch(function () {
                            lock = false;
                        });
                    }
                }
            }else{
                lock = false;
            }
        }else{
            process.stdout.write('.');
            if(countLock++ > 10){
                lock = false;
            }
        }
    },13000);

    console.log('Init Run');

    process.on('SIGINT', async function() {

        console.log("Caught interrupt signal");
        pages["YAMATO"].close();

        if (browser && browser.process() != null) {
            browser.process().kill('SIGINT');
        }
        await browser.close();
        process.exit();
    });
})();