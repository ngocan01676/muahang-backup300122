const puppeteer = require('puppeteer');
var cheerio = require('cheerio');
var encoding = require('encoding-japanese');
const pages = {};

 function YAMATO(tracking){
    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];

        await page.goto('http://track.kuronekoyamato.co.jp/english/tracking', { waitUntil: 'networkidle2' });
        await page.waitForSelector('#main');
        for(let index in tracking){
            let _index = parseInt(index)+1;
            await page.$eval('input[name="number'+((_index)<10?'0'+_index:_index)+'"]', (el,val) => el.value = val,tracking[index]);
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
                        let id = $(td[1]).find('input').val();
                        if(id){
                            Trackings[id] = {
                                Id : $(td[2]).text().replace(/^\s*|\s*$/g, ''),
                                Date : $(td[3]).text().replace(/^\s*|\s*$/g, ''),
                                Text : $(td[4]).text().replace(/^\s*|\s*$/g, ''),
                            };
                            Trackings[id].Status = Trackings[id].Text === "Delivered";
                        }
                    });
                }
            });
            console.log(Trackings);
            $("center table").each(function () {
               // console.log($(this).html());
            });
            resolve();
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
            await page.$eval('input[name="main:no'+(_index)+'"]', (el,val) => el.value = val,tracking[index]);
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
                        Trackings[id] = {
                            Id : id,
                            Date : $(td[1]).text().replace(/^\s*|\s*$/g, '').replace(/\s/g, " "),
                            Text : $(td[2]).text().replace(/^\s*|\s*$/g, ''),
                        };
                        Trackings[id].Status = Trackings[id].Text.indexOf('Delivered:')>=0;
                    }
                });
            });
            console.log(Trackings);

            resolve();
        },3000);
    });
}
async function JAPAN_POST(tracking){

    return new  Promise (async function (resolve, reject) {
        let page = pages["YAMATO"];
        await page.goto('https://trackings.post.japanpost.jp/services/srv/search/input', {waitUntil: 'networkidle2'});
        await page.waitForSelector('#content');

        for(let index in tracking){
            let _index = parseInt(index)+1;
            console.log('input[name="requestNo'+(_index)+'"]');
            await page.$eval('input[name="requestNo'+(_index)+'"]', (el,val) => el.value = val,tracking[index]);
        }

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
                    console.log("td:"+td.length);
                    if(td.length > 0){
                        let input = $(td[0]).find('a');
                        console.log("input:"+input.length);
                        if(input.length > 0){

                            if(td.length === 6){
                                let id = input.text();
                                last = id;
                                if(id){
                                    let key = id.replace(/-/g, "");
                                    Trackings[key] = {
                                        Id : id,
                                        Date : $(td[2]).text().replace(/^\s*|\s*$/g, '').replace(/\s/g, " "),
                                        Text : $(td[3]).text().replace(/^\s*|\s*$/g, ''),
                                    };
                                    Trackings[key].Status =Trackings[key].Status === "お届け先にお届け済み";
                                }
                            }
                        }
                    }
                });
            });
            console.log(JSON.stringify(Trackings));

            resolve();
        },3000);
    });
}
(async () => {
    const browser = await puppeteer.launch({ headless: true });

    pages["YAMATO"] =  await browser.newPage();
    pages["YAMATO"].setViewport({ width: 1280, height:720 });

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

    // let tYAMATO = setInterval(function () {
        pushData.push({name:"YAMATO",data:[380180590484,380179697192]});
    // },5000);
    // pushData.push({name:"SAGAWA",data:['4028-5282-4301','4025-1635-6745']});
    // let tSAGAWA = setInterval(function () {
        pushData.push({name:"SAGAWA",data:['4028-5282-4301','4025-1635-6745']});
    // },15000);
    // let tJAPAN_POST = setInterval(function () {
        pushData.push({name:"JAPAN_POST",data:['156482236175','156480922640']});
    // },25000);
    let lock = false;

    setInterval(function () {

        if(lock === false ){

            console.log('Action');

            if(pushData.length > 0){

                lock = true;

                let data = pushData.shift();
                if(data.hasOwnProperty('name') && configs.hasOwnProperty(data.name)){
                    console.log(data.name+' '+data.data.join(' '));
                    if(data.name === "YAMATO"){

                        YAMATO(data.data).then(function () {
                            lock = false;
                            console.log(data.name+' sucesss');
                        }).catch(function () {
                            lock = false;
                        });

                    }else if(data.name === "SAGAWA"){

                        SAGAWA(data.data).then(function () {
                            lock = false;

                            console.log(data.name+' sucesss');
                        }).catch(function () {
                            lock = false;
                        });

                    }else if(data.name === "JAPAN_POST"){
                        JAPAN_POST(data.data).then(function () {
                            lock = false;
                            console.log(data.name+' sucesss');
                        }).catch(function () {
                            lock = false;
                        });

                    }
                }
            }else{

            }
        }else{
            console.log('---');
        }
    },1000);

})();