const puppeteer = require('puppeteer');
var cheerio = require('cheerio');
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
    user    : 'root',
    password: 'xQAarXdcPL29D9fL',
    database: 'cms',
});

var moment = require('moment');
console.log("Time:"+moment().format("YYYY-MM-DD HH:mm:ss"));
let timeEnd = moment().add('-30','minutes').format("YYYY-MM-DD hh:mm:ss");
console.log(timeEnd);

async function YAMATO(tracking){
    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];
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
        await page.goto('http://k2k.sagawa-exp.co.jp/p/sagawa/web/okurijosearcheng.jsp', {waitUntil: 'networkidle2'});
        await page.waitForSelector('#main');

        for(let index in tracking){
            let _index = parseInt(index)+1;
            await page.$eval('input[name="main:no'+(_index)+'"]', (el,val) => el.value = val,tracking[index].id);
        }

       await page.click('input[name="main:toiStart"]');
        setTimeout(async function () {
            const inner_html = await page.evaluate(() => document.querySelector('body').innerHTML);
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
                                    }
                                }
                            }
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
            user    : 'root',
            password:'xQAarXdcPL29D9fL',
            database: 'cms',
        });
        conn.connect(function (err){
            if (err) throw err.stack;

            let timeEnd = moment().add('-'+(60*24*0.5),'minutes').format("YYYY-MM-DD HH:mm:ss");

            var sql = "SELECT * FROM `cms_shop_order_excel_tracking` where status != 1 and count<10 and (updated_at <= '"+timeEnd+"' or status=0) order by updated_at LIMIT 0,20";

            console.log(sql);

            let rows = {};
            let _databaseData = {};
            conn.query(sql, function (err,results, fields) {
                if (err) throw err;
                let count =0;
                for(let key in results){
                    let trangid = results[key].tracking_id;
                    if(trangid == "キャンセル"){
                        continue;
                    }
                    if(!_databaseData.hasOwnProperty(results[key].type)){
                        _databaseData[results[key].type] = {};
                    }
                    _databaseData[results[key].type][results[key].tracking_id] = results[key];
                    count++;
                }

                console.log('Data:'+count);

                databaseData = _databaseData;

                for(let name in databaseData){
                    for(let index in databaseData[name]){
                        conn.query('UPDATE `cms_shop_order_excel_tracking` SET count='+(databaseData[name][index].count+1)+',`status` = \'2\',`updated_at`=now() WHERE `id` = '+databaseData[name][index].id+';')
                    }
                }
                databaseLock = {};
                conn.end();
                lock = false;
                Cb();
            });

        });
    }
    function AddQueue(){

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
            console.log('AddQueue:'+pushData.length+" "+moment().format("YYYY-MM-DD HH:mm:ss"));
            if(pushData.length === 0){
                GetData(function () {

                });
            }
        }catch (e) {

        }
    }

    GetData(function () {
        AddQueue();
    });
    setInterval(function () {
        AddQueue();
    },60000);
    setInterval(function () {
        if(lock === false ){
            if(pushData.length > 0){
                lock = true;
                let data = pushData.shift();
                console.dir(data);
                if(data.hasOwnProperty('name') && configs.hasOwnProperty(data.name)){
                    console.log("Date:"+(moment().format("YYYY-MM-DD HH:mm:ss"))+data.name);


                    if(data.name === "YAMATO"){
                        YAMATO(data.data).then(function (vals) {
                            lock = false;
                            console.log("\n"+data.name+' sucesss \n');
                            log.info('YAMATO:'+JSON.stringify(vals));
                            for(let i in vals[1]){

                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;

                                    if(vals[0][vals[1][i].key].Status){
                                         sql = "UPDATE `cms_shop_order_excel_tracking` SET `status` = "+vals[0][vals[1][i].key].Status+",`data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `status` = "+vals[0][vals[1][i].key].Status+",`data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
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
                            console.log("\n"+data.name+' sucesss \n');
                            log.info('SAGAWA:'+ JSON.stringify(vals));

                            for(let i in vals[1]){
                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;
                                    if(vals[0][vals[1][i].key].Status){
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET `status` = "+vals[0][vals[1][i].key].Status+" , `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
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
                            console.log("\n"+data.name+' sucesss \n');
                            console.log(vals);
                            log.info('JAPAN_POST:'+JSON.stringify(vals));
                            for(let i in vals[1]){
                                if(vals[0].hasOwnProperty(vals[1][i].key)){
                                    let sql;
                                    if(vals[0][vals[1][i].key].Status){
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET `status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
                                    }else{
                                        sql = "UPDATE `cms_shop_order_excel_tracking` SET  `status` = "+vals[0][vals[1][i].key].Status+", `data`='"+JSON.stringify(vals[0][vals[1][i].key])+"',`updated_at`=now() WHERE `id` = "+vals[1][i].data.id;
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

            }
        }else{
            process.stdout.write('.');
        }
    },60000);

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