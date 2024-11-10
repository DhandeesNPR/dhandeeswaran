const hour=document.querySelector('.hrs');
const minute=document.querySelector('.min');
const second=document.querySelector('.sec');


function runClock(){
    const time=new Date();
    const Seconds=time.getSeconds()/60;
    const Minutes=(Seconds+time.getMinutes())/60;
    const Hours=(Minutes+time.getHours())/12;

    hour.style.setProperty('--rotation',Hours*360);
    minute.style.setProperty('--rotation',Minutes*360);
    second.style.setProperty('--rotation',Seconds*360);
}
runClock()
setInterval(runClock,1000);