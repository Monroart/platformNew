<template>
    <table style="border: 1px solid #ccc">
        <tr v-for="row in dateandtime" :key="row.rows">
            <td  v-for="item in row" style="border: 1px solid #ccc;width: 100px;height: 40px" :key="item.cols">

                <div v-if="item.message===currentclasstime.dateandtime">
                    <div style="text-align:center;line-height:40px;background-color: yellowgreen;width: 140px;height: 30px;font-size: 10px;font-weight: bold" >{{item.message}}(Здесь был Идрис)</div>
                </div>


                <div v-else-if="row.rows===0&&item.cols!==0">
                    <div style="text-align:center;line-height:40px;background-color: #2eff87;width: 140px;height: 30px;font-size: 20px;font-weight: bold" >{{item.message}}</div>
                </div>


                <div v-else-if="row.rows===1&&item.cols!==0">
                    <div style="text-align:center;line-height:40px;background-color: #29c6ea;width: 140px;height: 30px;font-size: 20px;font-weight: bold" >{{item.message}}</div>
                </div>


                <div v-else-if="row.rows!==1&&row.rows!==0&&item.cols===0">
                    <div style="text-align:center;line-height:40px;background-color: #ccc;width: 115px;height: 70px;font-size: 15px;font-weight: bold" >{{item.message}}</div>
                </div>


            </td>
        </tr>



    </table>
</template>


<script>
import {onMounted, reactive, toRefs} from "vue";

export default {
    setup() {
        const data = reactive({
            dateandtime:"",
            currentclasstime: {
                date: "",
                data: "",
                time: 1,
                dateandtime: ""
            },
        })

        onMounted(async () => {
                showdate()
            }
        )
        const showdate = () => {
            data.dateandtime = []
            for (let i = 0; i < 28; i++) {
                data.dateandtime[i] = {}
                data.dateandtime[i]['rows'] = i
                for (let j = 0; j < 8; j++) {
                    data.dateandtime[i][j] = {}
                    data.dateandtime[i][j]['cols'] = j
                    data.dateandtime[i][j]['message'] = ""
                    data.dateandtime[i][j]['coursename'] = ""
                    data.dateandtime[i][j]['teachername'] = ""
                    data.dateandtime[i][j]['location'] = ""
                    data.dateandtime[i][j]['remark'] = ""
                }
            }
            data.dateandtime[1][1]['message'] = "Понедельник"
            data.dateandtime[1][2]['message'] = "Вторник"
            data.dateandtime[1][3]['message'] = "Среда"
            data.dateandtime[1][4]['message'] = "Четверг"
            data.dateandtime[1][5]['message'] = "Пятница"
            data.dateandtime[1][6]['message'] = "Суббота"
            data.dateandtime[1][7]['message'] = "Воскресенье"
            data.dateandtime[2][0]['message'] = "(8:00-8:30)"
            data.dateandtime[3][0]['message'] = "(8:30-9:00)"
            data.dateandtime[4][0]['message'] = "(9:00-9:30)"
            data.dateandtime[5][0]['message'] = "(9:30-10:00)"
            data.dateandtime[6][0]['message'] = "(10:00-10:30)"
            data.dateandtime[7][0]['message'] = "(10:30-11:00)"
            data.dateandtime[8][0]['message'] = "(11:00-11:30)"
            data.dateandtime[9][0]['message'] = "(11:30-12:00)"
            data.dateandtime[10][0]['message'] = "(12:00-12:30)"
            data.dateandtime[11][0]['message'] = "(12:30-13:00)"
            data.dateandtime[12][0]['message'] = "(13:00-13:30)"
            data.dateandtime[13][0]['message'] = "(13:30-14:00)"
            data.dateandtime[14][0]['message'] = "(14:00-14:30)"
            data.dateandtime[15][0]['message'] = "(14:30-15:00)"
            data.dateandtime[16][0]['message'] = "(15:00-15:30)"
            data.dateandtime[17][0]['message'] = "(15:30-16:00)"
            data.dateandtime[18][0]['message'] = "(16:00-16:30)"
            data.dateandtime[19][0]['message'] = "(16:30-17:00)"
            data.dateandtime[20][0]['message'] = "(17:00-17:30)"
            data.dateandtime[21][0]['message'] = "(17:30-18:00)"
            data.dateandtime[22][0]['message'] = "(18:00-18:30)"
            data.dateandtime[23][0]['message'] = "(18:30-19:00)"
            data.dateandtime[24][0]['message'] = "(19:00-19:30)"
            data.dateandtime[25][0]['message'] = "(19:30-20:00)"
            data.dateandtime[26][0]['message'] = "(20:00-20:30)"
            data.dateandtime[27][0]['message'] = "(20:30-21:00)"
            data.dateandtime[2][1]['message'] = "Слот переполнен"
            data.dateandtime[2][2]['coursename'] = "Слот переполнен"
            data.dateandtime[2][3]['teachername'] = "Слот переполнен"
            data.dateandtime[2][4]['location'] = "Слот переполнен"
            data.dateandtime[2][5]['remark'] = "Слот переполнен"
            let current = new Date()
            let month1 = (current.getMonth() + 1) < 10 ? '0' + (current.getMonth() + 1) : current.getMonth() + 1;//获取当前月份
            let day1 = current.getDate() < 10 ? '0' + current.getDate() : current.getDate();//获取当前日份
            data.currentclasstime.dateandtime = month1 + "-" + day1
            let date = new Date();//获取当前时间
            date.setMonth(9 - 1)//设置当前月份为9月份
            for (let i = 1; i <= 7; i++) {
                date.setDate(i)//设置第九月份第一天
                let year = date.getFullYear()//获取当前年份
                let month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1;//获取当前月份
                let day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();//获取当前日份
                if (getweekday(year + "-" + month + "-" + day) === "Понедельник")//如果当前日期是星期一
                {
                    data.currentclasstime.data = year + "-" + month + "-" + day
                    for (let j = 0; j <= 6; j++)//遍历0到六  实际就是星期一到星期六
                    {
                        if (j !==0)//当前是星期一 日份不用加1
                            date.setDate(date.getDate() + 1)//日份加一 直到星期日为结束
                        year = date.getFullYear()
                        month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1;
                        day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
                        console.log("日份为", date.getDate())
                        data.dateandtime[0][j + 1]['message'] = month + "-" + day
                        if (j === 6) {
                            data.currentclasstime.date = date
                            data.currentclasstime.date.setDate(data.currentclasstime.date.getDate() + 1)
                            data.currentclasstime.data += ~year + "-" + month + "-" + day
                        }
                    }
                    break;

                }
            }

            /*const  time=new Data*/
            data.showdataevisiable = true;
            data.message=  "Current Week: Week"+data.currentclasstime.time+","+data.currentclasstime.data
        }

// 计算指定时间是星期几
        function getweekday(date){
            // date例如:'2022-03-05'
            var weekArray = ["Понедельник","Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"]
            var week  = weekArray[new Date(date).getDay()]
            return week
        }


        const thisweekfuntion = () => {

            while(data.currentclasstime.time!==1)//回到第一周
            {
                lastweekfuntion()
            }
            data.currentclasstime.date.setDate(data.currentclasstime.date.getDate()-7)
            console.log("当前日s为",data.currentclasstime.date.getDate())
            data.currentclasstime.time=0
            let current=new Date()
            let fortime=new Date()
            while(data.currentclasstime.time!==16)
            {
                fortime.setMonth(data.currentclasstime.date.getMonth())
                fortime.setDate(data.currentclasstime.date.getDate())
                console.log("当前开始日",fortime.getDate())
                for(let j=0;j<=6;j++) {
                    if (j !==0)
                        fortime.setDate(fortime.getDate() + 1)
                    if (fortime.getDate() === current.getDate() && fortime.getMonth() === current.getMonth())
                    {
                        nextweekfuntion()
                        return
                    }

                }
                nextweekfuntion()
            }
        }

        const lastweekfuntion=()=>{
            if(data.currentclasstime.time===1)
            {
                return
            }
            let date=new Date()
            date.setMonth(data.currentclasstime.date.getMonth())
            date.setDate(data.currentclasstime.date.getDate())
            date.setDate(date.getDate()-14)
            console.log("日份为",date.getDate())
            let year=date.getFullYear()//获取当前年份
            let month = (date.getMonth()+1)<10 ? '0'+(date.getMonth()+1) : date.getMonth()+1;//获取当前月份
            let day = date.getDate()<10 ? '0'+date.getDate() : date.getDate();//获取当前日份
            data.currentclasstime.data=year+"-"+month+"-"+day
            for(let j=0;j<=6;j++)//遍历0到六  实际就是星期一到星期六
            {
                if(j!==0)//当前是星期一 日份不用加1
                    date.setDate(date.getDate()+1)//日份加一 直到星期日为结束  date改变会引起data.currentclasstime.date改变
                year=date.getFullYear()
                month = (date.getMonth()+1)<10 ? '0'+(date.getMonth()+1) : date.getMonth()+1;
                day = date.getDate()<10 ? '0'+date.getDate() : date.getDate();
                data.dateandtime[0][j+1]['message'] = month+"-"+day
                if(j===6)
                {
                    data.currentclasstime.date=date
                    data.currentclasstime.date.setDate(data.currentclasstime.date.getDate()+1)
                    data.currentclasstime.data+=~year+"-"+month+"-"+day
                }
            }
            data.currentclasstime.time-=1
            data.message=  "Current Week: Week"+data.currentclasstime.time+","+data.currentclasstime.data
        }

        const nextweekfuntion=()=>
        {
            if(data.currentclasstime.time===16)
            {
                return
            }
            let date=new Date()
            date.setMonth(data.currentclasstime.date.getMonth())
            date.setDate(data.currentclasstime.date.getDate())
            console.log("日份为",date.getDate())
            let year=date.getFullYear()//获取当前年份
            let month = (date.getMonth()+1)<10 ? '0'+(date.getMonth()+1) : date.getMonth()+1;//获取当前月份
            let day = date.getDate()<10 ? '0'+date.getDate() : date.getDate();//获取当前日份
            data.currentclasstime.date=date
            data.currentclasstime.data=year+"-"+month+"-"+day
            for(let j=0;j<=6;j++)//遍历0到六  实际就是星期一到星期六
            {
                if(j!==0)//当前是星期一 日份不用加1
                    date.setDate(date.getDate()+1)//日份加一 直到星期日为结束
                year=date.getFullYear()
                month = (date.getMonth()+1)<10 ? '0'+(date.getMonth()+1) : date.getMonth()+1;
                day = date.getDate()<10 ? '0'+date.getDate() : date.getDate();
                data.dateandtime[0][j+1]['message'] = month+"-"+day
                if(j===6)
                {
                    data.currentclasstime.date=date
                    data.currentclasstime.date.setDate(data.currentclasstime.date.getDate()+1)
                    data.currentclasstime.data+=~year+"-"+month+"-"+day
                }
            }
            data.currentclasstime.time+=1
            data.message=  "Current Week: Week"+data.currentclasstime.time+","+data.currentclasstime.data

        }

//помогите я запутался

        return{
            thisweekfuntion,
            lastweekfuntion,
            showdate,
            nextweekfuntion,
            ...toRefs(data),
        }
        //
    }
}



</script>
