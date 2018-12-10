function getTime() {
    var stamp_time = new Date();
    var time = stamp_time.toLocaleTimeString();
    var date = stamp_time.toLocaleDateString();
    console.log(date + time);
    return date+" "+ time;

}